
% Some examples of using a frequency transform
RGB = imread('autumn.tif');    % this is included in most matlab distributions
I = rgb2gray(RGB);             % convert the image to a grayscale image.
I = double(I);                 % make it floating point so math doesn't go wonky

D = dct2(I);                   % compute the 2d DCT transform
imagesc(log(1+abs(D)))         % show it, using the log so see small values too.

D = D*0;                       % initialize D to be all zeros (but the same size).
D(17,12) = 1;                  % set one value to non-zero

imagesc(idct2(D));             % do the inverse DCT

%%                                             %ok, try keeping just the biggest values.
I = rgb2gray(RGB);
D = dct2(I);
[vals, idx] = sort(abs(D(:)),'descend');       % first, sort the values.  D(:) treats D like a 1-D vector so you sort all the values.
%%
D2 = D.*0;                                     % initialize D2 to be the right size

for dx = 1:4000
    
    D2(idx(dx)) = vals(dx);                    % put the "dx-th" biggest value into D2
    D2(idx(dx)) = D(idx(dx));

    imagesc(idct2(D2));                        % show the image represented by D2 so far.
    %imagesc(log(1+abs(D2)))
    axis off;                                  % cute things to make the picture better...
    title(dx);
    pause(0.01);
    drawnow;
end


%%  Images as vectors!
I = imread('peppers.png');
I = rgb2gray(I);
I = double(imresize(I,[70 100]));
imagesc(I);

imageVector = I(:);           

blurFilter = fspecial('Gaussian',[10 10],1.2);
transformMatrix = [];

for bx = 1:100
    for ax = 1:70
        tt = I .* 0;                     % initialize tt to be the right size.
        tt(ax,bx) = 1;                   % make just one location be a "1"
        G = imfilter(tt, blurFilter);    % make a "blur kernel" centered there.
        %imagesc(G .* I); drawnow;
        % outputIm(ax,bx) = sum(sum(G.*I));
        outputIm(ax,bx) = G(:)' * imageVector;   % treat G as a vector and compute the dot-product with the image.
        V = G(:);                                % 
        transformMatrix(:, end+1) = V;           % store this vector as the next column of the transform matrix.
    end
    disp(ax);
end

outputIm2 = transformMatrix' * imageVector;      % we can now "convolve the image with G" as a matrix multiplication

deBlurredImages = inv(transformMatrix') * outputIm2;  % or invert that transform.

