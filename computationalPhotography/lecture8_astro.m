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
    

f1 = find(Q(:,3) == 2);
f2 = find(Q(:,3) == 10);

%f2 = find(Q(:,3) == 10);

P1 = Q(f1,1:2);
P2 = Q(f2,1:2);

clf; hold on;
 plot(P1(:,1),P1(:,2),'+','MarkerSize', 10);
plot(P2(:,1),P2(:,2),'or','MarkerSize', 10);
hold off;
%% Assume that the points line up!
tform = cp2tform(P1, P2, 'projective');

% Oh boy, some features are wrong.  What could we do?
 Q2 = tformfwd(P1,tform)
 
clf; hold on;
plot(P1(:,1),P1(:,2),'ro','MarkerSize', 10 );
plot(P2(:,1),P2(:,2),'r+','MarkerSize', 10);
plot(Q2(:,1),Q2(:,2),'bo','MarkerSize', 10);

%%  I have points P1, and P2.  I want to find matches to nearby points.
D = [];
for x1 = 1:size(P1,1)
    for x2 = 1:size(P2,1)
        D(x1,x2) = sum(  (P1(x1,:) - P2(x2,:)).^2);
    end
end
%%
% Find close points from image 1:
clf;
for x1 = 1:size(P1,1)
    imagesc(M2(:,:,1)); hold on;
    plot(P1(x1,1), P1(x1,2),'mo','markerSize', 10,'lineWidth', 2); hold on;
    [val idx] = min(D(x1,:));

    plot(P2(idx,1), P2(idx,2),'c+','markerSize', 10,'lineWidth', 2);
    bestMatch1(x1) = idx;
    bestMatchVal1(x1) = val;
    title('best match from frame 1');
    %pause;
end
%
% Find close points from image 2:
for x1 = 1:size(P2,1)
    imagesc(M2(:,:,1)); hold on;
    plot(P2(x1,1), P2(x1,2),'mo','markerSize', 10,'lineWidth', 2); hold on;
    [val idx] = min(D(:,x1));

    plot(P1(idx,1), P1(idx,2),'c+','markerSize', 10,'lineWidth', 2);
    bestMatch2(x1) = idx;
    bestMatchVal2(x1) = val;
    title('best match from frame 2');
   % pause;
end

%% Check for good matches:
GM1 = [];
GM2 = [];
% does my best match have me as their best match?
numberOfGoodMatches = 0;
for x1 = 1:size(P1,1)
    if bestMatch2(bestMatch1(x1)) == x1  && bestMatchVal1(x1) < 20;
        numberOfGoodMatches = numberOfGoodMatches + 1;
        GM1(numberOfGoodMatches,:) = P1(x1,:);
        GM2(numberOfGoodMatches,:) = P2(bestMatch1(x1),:);
    end 
end
plot(GM1(:,1),GM1(:,2),'r+','MarkerSize', 10); hold on;
plot(GM2(:,1),GM2(:,2),'g+','MarkerSize', 10); hold on;

tform = cp2tform(GM1, GM2, 'projective');

G1to2 = tformfwd(GM1,tform);
imagesc(imtransform(M(:,:,1),tform,'XData',[1 size(M,2)], 'YData', [1 size(M,1)]))


Out1 = imtransform(M(:,:,1),tform,'XData',[1 size(M,2)], 'YData', [1 size(M,1)]);
clf;
imagesc(Out1(90:100, 340:350));
imagesc(M2(90:100, 340:350,2));

%%
tformNew = tform;
H = tform.tdata.Tinv;

tIM = M(:,:,1);
for tx = 1:100;
    % keep transforming the transformed image
    h1 = subplot(2,1,1);
    tIM = imtransform(tIM,tform,'XData',[1 size(M,2)],...
        'YData', [1 size(M,1)]);
    imagesc(tIM);
    title(tx);
    
    % keep transforming the original image
    %h2 = subplot(2,1,2);
    %tformNew = maketform('projective',inv(H)^tx);
    %tIM2 = imtransform(M(:,:,1),tformNew,'XData',[1 size(M,2)],...
    %    'YData', [1 size(M,1)]); 
    %imagesc(tIM2);
    %drawnow;
    
    %
    % keep transforming the original image
    h2 = subplot(2,1,2);
    tformNew = maketform('projective',H^tx);
    outIm = imtransform(M(:,:,tx),tformNew,'XData',[1 size(M,2)],...
        'YData', [1 size(M,1)]);
    STACK(:,:,tx) = outIm;
    imagesc(outIm);
    drawnow;
%    pause;
end

%% RANSAC TO Match P1 to P2:
clf; hold on;
plot(P1(:,1),P1(:,2),'+','MarkerSize', 10);
plot(P2(:,1),P2(:,2),'or','MarkerSize', 10);
hold off;
%%
% Pick four random points from P1 (first part of the sample):
tmpRND = randperm(size(P1,1));
Y1 = P1(tmpRND(1:4),:);
for yx = 1:4
    d = (Y1(yx,1) - P2(:,1)).^2 + (Y1(yx,2) - P2(:,2)).^2 ;
    [~, idx2] = min(d);
    Y2(yx,:) = P2(idx2,:);
end
%

clf; hold on;
plot(P1(:,1),P1(:,2),'+r','MarkerSize', 10);
plot(P2(:,1),P2(:,2),'or','MarkerSize', 10);
plot(Y1(:,1),Y1(:,2),'+b','MarkerSize', 10);
plot(Y2(:,1),Y2(:,2),'ob','MarkerSize', 10);

hold off;
%
tform = cp2tform(Y1, Y2, 'projective');

% Q2 = tformfwd(Y1,tform);  % check that these are exact matches
% Q2 is the predicted location of Y2.

Q2 = tformfwd(P1,tform);  % check that these are exact matches

% then count inliers.
for qx = 1:size(Q2,1);
    d = (Q2(qx,1) - P2(:,1)).^2 + (Q2(qx,2) - P2(:,2)).^2 ;
    if min(d)<9,
        INLIER(qx) = 1;
    else
        INLIER(qx) = 0;
    end
end
clf; hold on;
plot(P2(:,1),P2(:,2),'+', 'LineWidth',5);
IX = find(INLIER==1);
plot(Q2(:,1),Q2(:,2),'ro', 'LineWidth',5);
plot(Q2(IX,1),Q2(IX,2),'go', 'LineWidth',5,'MarkerSize',10);
drawnow;


%%
% Can we add constraints to the homographies?


% What is making the sky actually change?


% every homography is some matrix H^x?
%H = Kinv * R * K


% Let's talk about the camera calibration matrix



% How can we parameterize rotations?  Practical tools for optimizing over
% rotations with Rodrigues parameters.



% If images are one minute apart, what do we know about the rodrigues
% vector?


%%





