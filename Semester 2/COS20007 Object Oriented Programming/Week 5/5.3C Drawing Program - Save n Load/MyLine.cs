﻿using System;
using SplashKitSDK;

namespace DrawingProgram
{
    public class MyLine : Shape
    {
        private float _endX;
        private float _endY;

        public float EndX
        {
            get
            {
                return _endX;
            }
            set
            {
                _endX = value;
            }
        }

        public float EndY
        {
            get
            {
                return _endY;
            }
            set
            {
                _endY = value;
            }
        }

        public MyLine(Color clr, float endX, float endY) : base(clr)
        {
            _endX = SplashKit.MouseX() + 50;
            _endY = SplashKit.MouseY() + 50;
        }

        public MyLine() : this(Color.Red, 0, 0) { }
        

        public override void Draw()
        {
            if (Selected)
            {
                DrawOutLine();
            }
            SplashKit.DrawLine(COLOR, X, Y, EndX, EndY);
        }

        public override void DrawOutLine()
        {
            int radius = 2;
            SplashKit.FillCircle(Color.Black, X, Y, radius);
            SplashKit.FillCircle(Color.Black, EndX, EndY, radius);
        }

        public override bool IsAt(Point2D pt)
        {
            return SplashKit.PointOnLine(pt, SplashKit.LineFrom(X, Y, EndX, EndY));
        }

        public override void SaveTo(StreamWriter writer)
        {
            writer.WriteLine("Line");
            base.SaveTo(writer);
            writer.WriteLine(EndX);
            writer.WriteLine(EndY);
        }

        public override void LoadFrom(StreamReader reader)
        {
            base.LoadFrom(reader);
            EndX = reader.ReadInteger();
            EndY = reader.ReadInteger();
        }
    }
}

