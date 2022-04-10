% Lecture 10, Gradient Based image stuff.

im = imread('/Users/pless/Downloads/Marshall.jpg');
im = permute(im,[2 1 3]);
im = rgb2gray(im);
im = imresize(im,[256 192]);

imagesc(im);
axis off;
axis equal;
im = double(im)./255;
%%
indexImage = im;
indexImage(1:size(im(:))) = 1:size(im(:));
numPixels = size(im(:),1);

rowOfA = zeros(numPixels,1);
numrows = 0;
A = sparse([]);

for d2 = 1:(size(im,2)-1)
    for d1 = 1:(size(im,1)-1)
        % now make the matrix row that computes the derivative of x at
        % location d1,d2
        rowOfA = zeros(numPixels,1);
        rowOfA(indexImage(d1+1,d2)) = 1;
        rowOfA(indexImage(d1,d2)) = -1;
        numrows = numrows+1;
        A(numrows,:) = rowOfA;
        
        rowOfA = zeros(numPixels,1);
        rowOfA(indexImage(d1,d2+1)) = 1;
        rowOfA(indexImage(d1,d2)) = -1;
        numrows = numrows+1;
        A(numrows,:) = rowOfA;
    end
    disp(d2)
end

% compute the gradients:
ders = A*im(:);

%% Now we do terrible things to Marshall's derivatives:
ders2 = ders;
ders2 = sign(ders) .* sqrt(abs(ders))

outIm(:) = A\ders2;
imagesc(reshape(outIm,size(im)))

