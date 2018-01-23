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
for tx = 1:0.2:100;           
T = [tx./2,tx./5,0];           % Make a translation vector.
P2 = P + repmat(T,300,1);      % Move our points by that vector.
plot(P2(:,1)./P2(:,3), P2(:,2)./P2(:,3),'.'); % Project the points.
axis equal;                    % keep the coordinate system square
axis([-1 1 -1 1]);             % always have the same limits
drawnow;                       % force the 
end
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

%  Lecture 3:  First, clear the variables to start over.
clear;    % clear all the variables that matlab knows about
clf;      % clear the figure.
