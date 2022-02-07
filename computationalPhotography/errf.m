function [err] = errf(x,b,c);

predImage = imfilter(reshape(x,26,26), c, 'conv', 'circular');
diffImage = predImage - b;
err1 = sum(diffImage(:).^2);

[dx dy] = gradient(reshape(x,26,26));

EXP = 0.8;
gradMag = sqrt(dx(:).^2 + dy(:).^2);
err2 = sum(gradMag.^EXP);
err = err1 + err2;

if rand(1,1)<0.01;
    imagesc(reshape(x,26,26));
    title(err);
    drawnow;
    
end

return
