using System;
using SplashKitSDK;

namespace DrawingProgram
{
    public class Program
    {

        private enum ShapeKind
        {
            Rectangle,
            Circle,
            Line
        }

        public static void Main()
        {
            ShapeKind kindToAdd = ShapeKind.Circle;

            Drawing drawing = new Drawing();

            Window window = new Window("Shape Drawer", 800, 600);

            //event loop
            do
            {
                SplashKit.ProcessEvents();
                SplashKit.ClearScreen();

                //shape depending on key
                if (SplashKit.KeyTyped(KeyCode.RKey))
                {
                    kindToAdd = ShapeKind.Rectangle;
                }
                if (SplashKit.KeyTyped(KeyCode.CKey))
                {
                    kindToAdd = ShapeKind.Circle;
                }
                if (SplashKit.KeyTyped(KeyCode.LKey))
                {
                    kindToAdd = ShapeKind.Line;
                }

                //new shape
                if (SplashKit.MouseClicked(MouseButton.LeftButton))
                {
                    Shape ShapeDrawn;
                    if (kindToAdd == ShapeKind.Rectangle)
                    {
                        MyRectangle myRectangle = new();
                        ShapeDrawn = myRectangle;
                    }
                    else if (kindToAdd == ShapeKind.Circle)
                    {
                        MyCircle myCircle = new();
                        ShapeDrawn = myCircle;
                    }
                    else
                    {
                        MyLine myLine = new();
                        ShapeDrawn = myLine;
                    }
                    ShapeDrawn.X = SplashKit.MouseX();
                    ShapeDrawn.Y = SplashKit.MouseY();
                    drawing.AddShape(ShapeDrawn);
                }
                //delete
                if (SplashKit.KeyTyped(KeyCode.BackspaceKey) || SplashKit.KeyTyped(KeyCode.DeleteKey))
                {
                    foreach (Shape s in drawing.SelectedShapes())
                    {
                        drawing.RemoveShape(s);
                    }
                }
                //select
                if (SplashKit.MouseClicked(MouseButton.RightButton))
                {
                    drawing.SelectShapesAt(SplashKit.MousePosition());
                }
                //background color
                if (SplashKit.KeyTyped(KeyCode.SpaceKey))
                {
                    drawing.Background = SplashKit.RandomRGBColor(255);
                }
                drawing.Draw();
                SplashKit.RefreshScreen();
            } while (!window.CloseRequested);
        }
    }
}


            
