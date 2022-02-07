    I = im2double(imread('cameraman.tif'));
   I = imresize(I,0.1);
       imshow(I);
       title('Original Image (courtesy of MIT)');
  
       % Simulate a motion blur.
       LEN = 21;
       THETA = 11;
       PSF = fspecial('motion', LEN, THETA);
       blurred = imfilter(I, PSF, 'conv', 'circular');
  
       % Simulate additive noise.
       noise_mean = 0;
       noise_var = 0.0001;
       blurred_noisy = imnoise(blurred, 'gaussian', ...
                          noise_mean, noise_var);
       figure, imshow(blurred_noisy)
       title('Simulate Blur and Noise')
  
       % Try restoration assuming no noise.
       estimated_nsr = 0;
       wnr2 = deconvwnr(blurred_noisy, PSF, estimated_nsr);
       figure, imshow(wnr2)
       title('Restoration of Blurred, Noisy Image Using NSR = 0')
  
       % Try restoration using a better estimate of the noise-to-signal-power 
       % ratio.
       estimated_nsr = noise_var / var(I(:));
       wnr3 = deconvwnr(blurred_noisy, PSF, estimated_nsr);
       figure, imshow(wnr3)
       title('Restoration of Blurred, Noisy Image Using Estimated NSR');
 
       
       %%
       for ex = 0:0.00001:0.003;
           wnr3 = deconvwnr(blurred_noisy, PSF, ex);
           imagesc(wnr3); title(ex); drawnow;
       end
       
%% Robert's implementation:

%      minx ‖b – c ∗ x‖2 + ‖∇x‖2
c = PSF;
b = blurred;
x = randn(size(I));
x = b;
OPTS = optimset;
x = fminsearch('errf',x(:),OPTS,b,c);
 
%%
x = rand(size(I));
x = b;
for ix = 1:100;
    predImage = imfilter(x, c, 'conv', 'circular');
    diffImage = b - predImage;
    x = x + 0.1 .* imfilter(diffImage,c,'conv','circular');
    
 %   smoothImage = imfilter(x, ones(3,3)./9, 'conv', 'circular');
 %   x(x<smoothImage) =  x(x<smoothImage) + 0.1;
 %   x(x>smoothImage) = x(x>smoothImage) - 0.1;
    diff2 = -(x-smoothImage);
    x = x + 0.1 * diff2;
        
    imagesc(smoothImage);
    drawnow;
end
