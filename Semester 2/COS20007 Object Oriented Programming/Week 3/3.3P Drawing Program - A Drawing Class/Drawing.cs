using System;
using SplashKitSDK;
using System.Linq;
using System.Collections.Generic;

namespace DrawingShape
{
    public class Drawing
    {
        public readonly List<Shape> _shapes;
        private Color _background;


        public Drawing(Color background)
        {
            _shapes = new List<Shape>();
            _background = background;
        }

        //default constructor
        public Drawing() : this(Color.White)
        {

        }

        //list of currently selected shapes
        public List<Shape> SelectedShapes()
        {
            List<Shape> result = new List<Shape>();
                foreach (Shape s in _shapes)
                {
                    if (s.Selected == true)
                    {
                        result.Add(s);
                    }
                }
                return result;          
        }

        public int ShapeCount
        {
            get
            {
                return _shapes.Count;
            }
        }

        //background color
        public Color Background
        {
            get
            {
                return _background;
            }
            set
            {
                _background = value;
            }
        }



        public void Draw()
        {
            SplashKit.ClearScreen(_background);

            foreach (Shape shape in _shapes)
            {
                shape.Draw();
            }
        }

        public void ShapeColor()
        {
            foreach (Shape s in _shapes)
            {
                if (s.Selected)
                {
                    s.Colors = Color.RandomRGB(255);
                }
            }
        }

        public void SelectShapesAt(Point2D pt)
        {
            foreach (Shape s in _shapes)
            {
                if (s.IsAt(pt))
                {
                    s.Selected = true;
                }
                else
                {
                    s.Selected = false;
                }
            }
        }


        public void AddShape(Shape shape)
        {
            _shapes.Add(shape);
        }

        public void RemoveShape(Shape shape)
        {
            _shapes.Remove(shape);
        }
    }
}