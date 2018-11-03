% new test 

plyName = '/Users/pless/Downloads/2017-06-20__22-18-33-051/e0c695a7-7df2-4eef-819c-204296ce239d__Top-heading-east_0.ply';
gName = '/Users/pless/Downloads/2017-06-20__22-18-33-051/e0c695a7-7df2-4eef-819c-204296ce239d__Top-heading-east_0_g.png';
pName = '/Users/pless/Downloads/2017-06-20__22-18-33-051/e0c695a7-7df2-4eef-819c-204296ce239d__Top-heading-east_0_p.png';
jsonDir = '/Users/pless/Downloads/2017-06-20__22-18-33-051';
%%
P = plyread2(plyName);
gIm = imread(gName);
pIm = imread(pName);

h1 = subplot(1,2,1);
imagesc(gIm); title('gim');

h2 = subplot(1,2,2);
imagesc(pIm); title('pim');
linkaxes([h1 h2]);

%%

%%

gIm2 = pIm.*0;
gIm2(:,3:2050) = gIm(:,1:2048);
h1 = subplot(1,2,1);
imagesc(gIm2); title('gim');

h2 = subplot(1,2,2);
imagesc(pIm); title('pim');
linkaxes([h1 h2]);
%%
gImT = gIm2';
goodPixelsIDX = find(gImT>63);
g3 = double(0.*gImT);
g2 = g3;
g1 = g3;
g3(goodPixelsIDX(1:end-26)) = P(3,:);
g1(goodPixelsIDX(1:end-26)) = P(1,:);
g2(goodPixelsIDX(1:end-26)) = P(2,:);

g3(g3==0) = -1400;

h1 = subplot(1,3,1);
imagesc(pIm); title('pim');

h2 = subplot(1,3,2);
imagesc(g3'); title('pim reconstructed');

h3 = subplot(1,3,3);
imagesc(gIm2); title('gim2');
linkaxes([h1 h2 h3]);

%BAD MATCHES START AT 49360rr


%%

gIm2 = pIm.*0;
gIm2(:,3:2050) = gIm(:,1:2048);
h1 = subplot(1,3,1);
imagesc(gIm2); title('gim');

h2 = subplot(1,3,2);
imagesc(pIm); title('pim');

h3 = subplot(1,3,3);
pp = double(0.* pIm');
pp(goodPixelsIDX(49360:49360)) = 1;
imagesc(pp);
pp2 = bwdist(pp);
pp2(pp2==0) = max(pp2(:));
imagesc(pp2');
linkaxes([h1 h2 h3]);

%%
rr = 1:155;
plot3(P(1,rr),P(2,rr),P(3,rr),'.');
rr = 1:10:100000;
scatter3(P(1,rr),P(2,rr),P(3,rr),10,rr,'filled');

%%
M = [P(1,rr); P(2,rr); P(3,rr)];
clf;
hold on;
for ix = 1:1:500
    M = [P(1,1:ix); P(2,1:ix); P(3,1:ix)];
    M(1,:) = M(1,:) - mean(M(1,:));
    M(2,:) = M(2,:) - mean(M(2,:));
    M(3,:) = M(3,:) - mean(M(3,:));
    plot(ix,rank(M),'r.');
    drawnow;
end



%% ok, for the first couple thousand points, things kinda work:
% See, all these are on a plane:
plot3(g1(1025,1:5000),g2(1025,1:5000),g3(1025,1:5000),'.')

% Let's find the planes for every *row* of the gIm matrix.
for px = 1:5000;
    gP = [g1(:,px),g2(:,px),g3(:,px)];
    badIdx = gP(:,3)<-1399;
    gP(badIdx,:) = [];
    if size(gP,1)>5
        x = gP\ones(size(gP,1),1);
        rowPlanes(:,px) = x;
    end
end

for px = 1:2050;
    gP = [g1(px,:);g2(px,:);g3(px,:)]';
    badIdx = gP(:,3)<-1399;
    gP(badIdx,:) = [];
    if size(gP,1)>5
        x = gP\ones(size(gP,1),1);
        colPlanes(:,px) = x;
    end
end

    


