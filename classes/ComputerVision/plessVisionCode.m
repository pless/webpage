% Lecture 2 code snippet.

% Make a small set of points in 3D.  A little cross that has a stick 
% coming out of the middle.
P(1:100,1) = 0;
P(1:100,2) = -49:50;
P(1:100,3) = 100;

P(101:200,1) = -49:50;
P(101:200,2) = 0;
P(101:200,3) = 100;

P(201:300,1) = 0;
P(201:300,2) = 0;
P(201:300,3) = 90.1:0.1:100;

% Plot those points
plot3(P(:,1),P(:,2),P(:,3),'.')
% Wow, the stick out of the middle looks big!  Let's fix that:
axis equal         % this forces all 3 axes to have the same units.

% Now let's project that using a "normalized camera"
  plot(P(:,1)./P(:,3), P(:,2)./P(:,3),'.');

  %% effects of translation
  for tx = 1:020:100;
      T = [tx./2,tx./5,0];           % Make a translation vector.
      P2 = P + repmat(T,300,1);      % Move our points by that vector.
      plot(P2(:,1)./P2(:,3), P2(:,2)./P2(:,3),'.'); % Project the points.
      axis equal;                    % keep the coordinate system square
      axis([-1 1 -1 1]);             % always have the same limits
      drawnow;                       % force the
  end
%%
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

%  Lecture 3:  First, clear the variables to start over.
clear;    % clear all the variables that matlab knows about
clf;      % clear the figure.

ptCloud = pcread('teapot.ply');
P = ptCloud.Location;
P = P(:,[1 3 2])
%% Make an image that is "Full HD".  1920 x 1080
% move the teapot
P(:,3) = P(:,3) + 10;

%%
x = P(:,1)./ P(:,3);
y = P(:,2)./P(:,3);
xFinal = x*800 + 960;         % multiply by focal length and add image center (half of 1920)
yFinal = y*800 + 540;
plot(xFinal,yFinal,'.');
axis([1 1920 1 1080])
hold;

% we should be able to do this with a K matrix and homogenous coordinates
% also.
K = [800 0 960 
     0 800 540
     0 0 1];
 
P2 = K * P';
P2 = P2';
plot(P2(:,1)./P2(:,3),P2(:,2)./P2(:,3),'ro');
axis([1 1920 1 1080])
%%
for tx = 1:0.1:9
T = [0 0 10];
R = rotationVectorToMatrix([0 2*tx 0]);

P3 = R*P' + repmat(T', 1, size(P,1));
P4 = K * P3;
P4 = P4';
plot(P4(:,1)./P4(:,3), P4(:,2)./P4(:,3),'.');
axis([1 1920 1 1080])
drawnow;
end

% What about a camera that is 640 x 480 with a camera center at 320x240?



%% Now let's put it all together.
X = P(:,1);
Y = P(:,2);
Z = P(:,3);

P = P + rand(size(P)).*0.001;

x = P4(:,1)./P4(:,3);
y = P4(:,2)./P4(:,3);

A = [];
b = [];
for a = 1:size(P,1);
    twoRows = [X(a) Y(a) Z(a) 1 0    0    0    0 -x(a)*X(a) -x(a)*Y(a) -x(a)*Z(a)
               0    0    0    0 X(a) Y(a) Z(a) 1 -y(a)*X(a) -y(a)*Y(a) -y(a)*Z(a)];
    A(end+1:end+2,:) = twoRows;
    b(end+1) = x(a);
    b(end+1) = y(a);  
end

k = A\b';
PROJ = [k(1) k(2) k(3) k(4)
        k(5) k(6) k(7) k(8)
        k(9) k(10) k(11) 1];
%%
%lookfor...

[a b] = qr(PROJ(1:3,1:3));

%%
P5 = P;
P5(:,4) = 1;
tmp = PROJ * P5';
xx=tmp(1,:)./tmp(3,:);
yy = tmp(2,:)./tmp(3,:);
plot(xx,yy,'*k');

%%
M = PROJ(1:3,1:3)';
   [Q,R1] = qr(flipud(M)')
    R1 = flipud(R1');
    R1 = fliplr(R1);

    Q = Q';   
    Q = flipud(Q);

    
    %%
im = imread('/Users/pless/data/TERRA/2017-08-04__08-43-28-707/c0efaa6d-e64b-488b-a432-a628bb0f24cd__Top-heading-west_0_g.png');
im = im(1001:2000,1:1000);
imagesc(im);
[imh, imw] = size(im);
 
hs = 512; % filter half-size
fil = fspecial('gaussian', hs*2+1, 300); 
 
fftsize = 1024; % should be order of 2 (for speed) and include padding
im_fft  = fft2(im,  fftsize, fftsize);                    % 1) fft im with padding
fil_fft = fft2(fil, fftsize, fftsize);                    % 2) fft fil, pad to same size as image
im_fil_fft = im_fft .* fil_fft;                           % 3) multiply fft images
im_fil = ifft2(im_fil_fft);                               % 4) inverse fft2
im_fil = im_fil(1+hs:size(im,1)+hs, 1+hs:size(im, 2)+hs); % 5) remove padding

%% fft2 refire:
im = imread('/Users/pless/Desktop/prokudin-gorskii-5.png');
im = rgb2gray(im);
im = im-mean(im(:));
F=fft2(double(im));
S=fftshift(F);


%S(282:285,280:290) = 0;  % Stomp on the center.
%S(282:285,:) = 0;        % stomp on the vertical.
%S(:,280:290) = 0;        % stopp on the horizontal.

% stomp on avertical
%S(282:285,:) = 0;


%keep only the center.
S2 = zeros(size(S));
b = 200;
S2(280-b:286+b,286-b:268+b) = S(280-b:286+b,286-b:268+b);
S = S2;

% reconsruct the image:
F2 = ifftshift(S);
im2 = real(ifft2(F2));
imagesc(im2,[-200 200]);



%%
L=log2(S);
A=abs(L);
imagesc(A);

