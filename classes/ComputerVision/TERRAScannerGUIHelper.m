function TERRAScannerGUIHelper(src,event,x)

mydata = get(gcf,'UserData');

switch event.EventName
    case 'WindowKeyPress'
        disp(event.Key)
        switch event.Key
            case 'r',
                  xlabel('*(R)oot, (L)eaf');
                  mydata.currentMode = 'R';
                  set(gcf,'UserData',mydata);
            case 'l',
                  xlabel('(R)oot, *(L)eaf');
                  mydata.currentMode = 'L';
                  set(gcf,'UserData',mydata);
            otherwise,
                  xlabel('(R)oot, (L)eaf, *(otherwise)');
                  mydata.currentMode = 'O';
                  set(gcf,'UserData',mydata);
        end

    case 'Hit'
        clickPosition = event.IntersectionPoint
        if mydata.currentMode ~= 'O';
            updateLabelImage(clickPosition,mydata)
            updateDisplayedImage

        else
            updateDisplayedImage
        end
end

%% Helper Helper Functions

function updateLabelImage(clickPosition,mydata)
labelIm = mydata.labelImage;
depthIm = mydata.depthImage;
clickPosition = round(clickPosition);
newLabels = markHigherPlantPixels(depthIm,labelIm,clickPosition(2),clickPosition(1));
if mydata.currentMode == 'R'
    labelIm(newLabels==2) = 2;
elseif mydata.currentMode == 'L'
    labelIm(newLabels==2) = 1;
else
    disp('something is wrong');
end
mydata.labelImage = labelIm;
set(gcf,'UserData',mydata);
return;
   
   
   
function updateDisplayedImage
% Get the image data
mydata = get(gcf,'UserData');

depthImage = double(mydata.depthImage);
labelImage = double(mydata.labelImage);

xLim = get(gca,'XLim');
yLim = get(gca,'YLim');

aRange =ceil(yLim(1)):floor(yLim(2));
bRange = ceil(xLim(1)):floor(xLim(2));

localDepthImage = depthImage(aRange,bRange);
minVal = min(localDepthImage(localDepthImage(:)>0));
maxVal = max(localDepthImage(:));
%set(gca,'CLim',[minVal maxVal]);

depth = (depthImage-minVal)./(maxVal-minVal);
depth = max(0,depth);
depth = min(1,depth);

tt = get(gca,'Children')
CDATA = cat(3,depth,depth.*labelImage~=1, depth.*labelImage~=2);
CDATA = cat(3,depth,depth.*(labelImage>0), depth.*(labelImage<2));
set(tt,'CData',CDATA);

disp('maxlabelimage:');
disp(max(labelImage(:)));
drawnow;
return;

        
        %% 
