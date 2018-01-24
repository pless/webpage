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
R = rotationVectorToMatrix([0 0.2*tx 0]);

P3 = R*P' + repmat(T', 1, size(P,1));
P4 = K * P3;
P4 = P4';
plot(P4(:,1)./P4(:,3), P4(:,2)./P4(:,3),'.');
axis([1 1920 1 1080])
drawnow;
end

% What about a camera that is 640 x 480 with a camera center at 320x240?



%% Now let's put it all together.
X = P4(:,1);
Y = P4(:,2);
Z = P4(:,3);

x = P4(:,1)./P4(:,3);
y = P4(:,2)./P4(:,3);

A = [];
b = [];
for a = 1:size(P4,1);
    twoRows = [X(a) Y(a) Z(a) 1 0    0    0    0 -x(a)*X(a) -x(a)*Y(a) -x(a)*Z(a)
               0    0    0    0 X(a) Y(a) Z(a) 1 -y(a)*X(a) -y(a)*Y(a) -y(a)*Z(a)];
    A(end+1:end+2,:) = twoRows;
    b(end+1) = x(a);
    b(end+1) = y(a);
    
end

       
    
    


%lookfor...
