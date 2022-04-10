function [tform] = ransacHomography(Q1, Q2)
% Given potentially corresponding points P1 and P2, solve for the
% homography matching them.  This function assumes that mutually closest
% points are the only possible matches.

VISUALIZE = 1;
if VISUALIZE
    clf; 
    plot(Q1(:,1),Q1(:,2),'r+'); hold on;
    plot(Q2(:,1),Q2(:,2),'b*'); hold off;
end

%% First, let's check if the homography that uses all points just works
tform = cp2tform(Q1, Q2, 'projective');

Q2p = tformfwd(Q1,tform);
diffVector = Q2p - Q2;
meanError = mean(sqrt(sum(diffVector.^2,2)));
maxError = max(sqrt(sum(diffVector.^2,2)));

if maxError > 1
    %% Otherwise, we need to try something Ransac-y
    % Try 1000 random samples.
    
    bestNumInliers = 0;
    
    for rx = 1:1000
        RR = randperm(size(Q1,1));
        rdx = RR(1:4);
        S1 = Q1(rdx,:);
        S2 = Q2(rdx,:);
        
        tform = cp2tform(S1, S2, 'projective');
        Q2p = tformfwd(Q1,tform);
        diffVector = Q2p - Q2;
        errPerPoint = sqrt(sum(diffVector.^2,2));
        meanError = mean(errPerPoint);
        maxError = max(errPerPoint);
        
        numInliers = sum(errPerPoint<1);
        
        if numInliers > bestNumInliers
            bestNumInliers = numInliers;
            besttform = tform;
            inliersIdx = find(errPerPoint<1);
            disp('Best num Inliers found so far: ');
            disp(bestNumInliers)
        end
    end
    %
    S1 = Q1(inliersIdx,:);
    S2 = Q2(inliersIdx,:);
    tform = cp2tform(S1, S2, 'projective');
end

