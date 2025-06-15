namespace ClockClass
{
    class MainClass
    {
        public static void Main(string[] args)
        {
            Clock myClock = new Clock();

            int i = 0;
            while (i < 260)
            {
                myClock.Tick();
                Console.WriteLine(myClock.Time);
                i++;
            }
            Console.ReadLine();
        }
    }
}