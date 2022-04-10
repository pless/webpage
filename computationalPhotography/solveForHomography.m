im1 = imread('~/Desktop/IMG_7097.jpeg');
im2 = imread('~/Desktop/IMG_7098.jpeg');

subplot(1,2,1); imagesc(im1);
subplot(1,2,2); imagesc(im2);

title('click on four points on image 1');
[x y] = ginput(4);
title('click on the same four point in the same order in image 2');
[xp yp] = ginput(4);

%%
for ix = 1:4
    subplot(1,2,1);
    hold on;
    text(x(ix),y(ix),num2str(ix));
    subplot(1,2,2);
    hold on;
    text(xp(ix),yp(ix),num2str(ix));
end
%%
M = [];
for ix = 1:4
    M(2*ix-1,:) = [x(ix) y(ix) 1 0     0     0 -x(ix)*xp(ix) -y(ix)*xp(ix)]
    M(2*ix  ,:) = [0     0     0 x(ix) y(ix) 1 -x(ix)*yp(ix) -y(ix)*yp(ix)]
    b(2*ix-1) = xp(ix);
    b(2*ix)   = yp(ix);
end

xV = M\b;

H = [xV(1) xV(2) xV(3)
    xV(4) xV(5) xV(6) 
    xV(7) xV(8) 1];

P = [x(2) y(2) 1]';
 
Pprime = H*P;
Pprime = Pprime ./ Pprime(3)
Pprime(1:2)
[xp(2) yp(2)]'
%%
im1Bigger = im1;
for jx = 3025:4000;
    for yx = 1:4000
        P = [jx yx 1]';
        Pprime = H*P;
        Pprime = Pprime ./ Pprime(3);
        xInOtherImage = Pprime(1);
        yInOtherImage = Pprime(2);
        if xInOtherImage>1 & xInOtherImage < size(im2,1) & ...
                yInOtherImage>1 & yInOtherImage<size(im2,1)
            im1Bigger(yx,jx,:) = im2(round(yInOtherImage),round(xInOtherImage),:);
        end
    end
    figure(2); imagesc(im1Bigger); title(jx);
end
