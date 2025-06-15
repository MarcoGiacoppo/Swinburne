using System;
using SplashKitSDK;

namespace DrawingProgram
{
	public class MyCircle : Shape
	{
		//local var
		private int _radius;

		//constructor
		public MyCircle(Color clr, int radius) : base(clr)
		{
			_radius = radius;
		}

		public MyCircle() : this(Color.Blue, 50) { }

        //methods
        public override void Draw()
        {
			if (Selected)
			{
				DrawOutLine();
			}
			SplashKit.FillCircle(COLOR, X, Y, _radius);
        }

        public override void DrawOutLine()
        {
			SplashKit.FillCircle(Color.Black, X, Y, _radius + 2);
        }

		public override bool IsAt(Point2D pt)
		{
			Circle circle = new Circle()
			{
				Center = new Point2D()
				{
					X = X,
					Y = Y,
				},
				Radius = _radius
			};
			return SplashKit.PointInCircle(pt, circle);
		}
    }
}

