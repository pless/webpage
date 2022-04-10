function [Q1 Q2 IDX1 IDX2] = findMutualNearestNeighbors(P1, P2)
% Given potentially corresponding points P1 and P2, solve for mutually closest
% points (which we assume are possible matches).

VISUALIZE = 0;
%%  First, find distances between points:

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
    [val idx] = min(D(x1,:));
    bestMatch1(x1) = idx;
    bestMatchVal1(x1) = val;
    
    if VISUALIZE
        clf
        plot(P1(x1,1), P1(x1,2),'mo','markerSize', 10,'lineWidth', 2); hold on;
        plot(P2(idx,1), P2(idx,2),'c+','markerSize', 10,'lineWidth', 2);
        title('best match from frame 1');
        pause;
    end
end
%
% Find close points from image 2:
for x1 = 1:size(P2,1)
    [val idx] = min(D(:,x1));
    bestMatch2(x1) = idx;
    bestMatchVal2(x1) = val;
    
    if VISUALIZE
        clf;
        plot(P2(x1,1), P2(x1,2),'mo','markerSize', 10,'lineWidth', 2); 
        plot(P1(idx,1), P1(idx,2),'c+','markerSize', 10,'lineWidth', 2);
        title('best match from frame 2');
        hold off;
        pause;
    end
    
end

%% Check for good matches:
GM1 = [];
GM2 = [];
% does my best match have me as their best match?
numberOfGoodMatches = 0;
for x1 = 1:size(P1,1)
    if bestMatch2(bestMatch1(x1)) == x1
        numberOfGoodMatches = numberOfGoodMatches + 1;
        IDX1(numberOfGoodMatches) = x1;
        IDX2(numberOfGoodMatches) = bestMatch1(x1);
        GM1(numberOfGoodMatches,:) = P1(x1,:);
        GM2(numberOfGoodMatches,:) = P2(bestMatch1(x1),:);
    end 
end

%% ok, let's  visualize these?
if VISUALIZE
    clf
    hold on;
    plot(GM1(:,1),GM1(:,2),'r+','MarkerSize', 10); hold on;
    plot(GM2(:,1),GM2(:,2),'g+','MarkerSize', 10); hold on;
    title('Matching points');
    hold off;
end

Q1 = GM1;
Q2 = GM2;