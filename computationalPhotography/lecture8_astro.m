% Computational  Astrophotography
% ... or making really awesome images by stacking them
% ... after figuring out how to align them!

%Canada France Hawaii Telescope Webcam
webcamURL = 'https://www.cfht.hawaii.edu/webcams/cfhtdome/cfhtdome.jpg';

% Key idea #1: Find a good set of images

for jx = 1:0;
    im = imread('https://www.jb.man.ac.uk/common/webcam.jpg');
    fname = [datestr(clock,'yyyymmdd_HHMMSS') '.jpg'];
    fullFilename = ['~/Desktop/astro/' fname];
    imwrite(im,fullFilename,'Quality', 100);
    pause(60);
end

%%
videoName = '/Users/pless/Desktop/cfhtdome220319.mp4';
videoName = '/Users/pless/Desktop/cloudcam1220313.mp4';
vidObj = VideoReader(videoName);
vidFrame = readFrame(vidObj);
nF = vidObj.numFrames-1;

nF = 500;
allFrames = [];
for ix = 1:nF
    vidFrame = readFrame(vidObj);
   % im = double(rgb2gray(vidFrame(40:240,800:1250,:)))./255;
    im = double(rgb2gray(vidFrame(1:500,:,:)))./255;
    allFrames(:,:,ix) = im;
    disp(ix);
end
%%
% Show a slice through time:
imagesc(squeeze(allFrames(:,60,:)))


% ... to pick out the best data...
M = allFrames(:,:,100:200);

%% let's make a filter to highlight "stars".

F = fspecial('Gaussian',[21 21],1.3) - fspecial('Gaussian',[21 21],7);

%% list of possible points
M2 = [];
M2 = M .* 0;
for mx = 1:size(M,3);
    im2 = imfilter(M(:,:,mx),F);
    M2(:,:,mx) = im2;
    imagesc(im2);
    axis off; title(mx); drawnow;
end

imagesc(max(M2,[],3));

%% oy, the boundaries look bright.  let's squash that.
M2(1:11,:,:) = 0;
M2(end-11:end,:,:) = 0;
M2(:,1:11,:) = 0;
M2(:,end-11:end,:) = 0;

% Let's find some features:
numPoints = 0;
Q = [];
for mx = 1:size(M2,3);
    starImage = M2(:,:,mx) > 0.1;
    R = regionprops(starImage);
    for rx = 1:size(R,1);
        P = R(rx).Centroid;
        P(3) = mx;                              % put in the frame number
        numPoints = numPoints + 1;
        Q(numPoints,:) = P;
    end
    disp(mx);
end

plot3(Q(:,1),Q(:,2),Q(:,3),'.')
zlabel('time');

%% Now, lets visualize this and see what stars we're seeing.
% overlay points onto image:
imagesc(M(:,:,1))
f1 = find(Q(:,3) == 1);
hold on;                       % don't erase the image before we plot points
plot(Q(f1,1),Q(f1,2),'+','markerSize', 10,'lineWidth', 3);
hold off;
% woah, looks like we got the "x,y" vs. "row, column" correct!

%% ok, let's see if we can do some homographies:
f1 = find(Q(:,3) == 1);
f2 = find(Q(:,3) == 2);

P1 = Q(f1,1:2);
P2 = Q(f2,1:2);

%% find possible matches
[Q1 Q2] = findMutualNearestNeighbors(P1,P2);
tform = ransacHomography(Q1,Q2);

%%  Let's start at frame 30
f1 = find(Q(:,3) == 30);
P1 = Q(f1,1:2);
UpdatedP1 = P1;
registeredStack = [];

for fx = 30:1:60;
%     clf
%     hold on;
%     plot(UpdatedP1(:,1),UpdatedP1(:,2),'r+');
%     plot(P2(:,1),P2(:,2),'b+');
%     drawnow; title(fx);

    f2 = find(Q(:,3) == fx);
    P2 = Q(f2,1:2);
    [Q1 Q2 IDX1 IDX2] = findMutualNearestNeighbors(UpdatedP1,P2);
    Q1 = P1(IDX1,:);
    Q2 = P2(IDX2,:);
    tform = ransacHomography(Q2,Q1);
    HH{fx} = tform;
    UpdatedP1 = tforminv(P1,tform);
    disp(tform.tdata.T);
    imOut = imtransform(M(:,:,fx),tform,...
        'XData',[1 size(M,2)], 'YData',[1 size(M,1)]);
    imagesc(imOut); drawnow;
    
    registeredStack(:,:,fx) = imOut;
end

%%
h1 = subplot(1,2,1); imagesc(registeredStack(:,:,30));
h2 = subplot(1,2,2); imagesc(sum(registeredStack,3));
linkaxes([h1 h2])
%%


h1 = subplot(1,2,1); imagesc(imfilter(registeredStack(:,:,30),F));
h2 = subplot(1,2,2); imagesc(imfilter(sum(registeredStack,3),F));
linkaxes([h1 h2])
%%
A1 = registeredStack(:,:,30);
A2 = sum(registeredStack,3);

A1 = A1./max(A1(:));
A2 = A2./max(A2(:));

A1 = imfilter(A1,F);
A2 = imfilter(A2,F);

h1 = subplot(1,2,1); imagesc(A1);
h2 = subplot(1,2,2); imagesc(A2);
linkaxes([h1 h2])
%%
A1 = max(A1,0.001);
A2 = max(A2,0.001);

h1 = subplot(1,2,1); imagesc(log(.01+A1));
h2 = subplot(1,2,2); imagesc(log(.01+A2));
linkaxes([h1 h2])

%%
clear HH

for ix = 1:3
    HH{ix} = subplot(2,2,ix);
    imagesc(imfilter(registeredStack(:,:,30+ix),F),[0 .02]);
end
HH{4} = subplot(2,2,4);
imagesc(imfilter(A2,F),[0 .02]);
linkaxes([HH{1} HH{2} HH{3} HH{4}])
