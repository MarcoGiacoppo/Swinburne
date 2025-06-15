using System;
namespace SimpleCard
{
    public class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("Welcome to the Simple Card Game!");
            Console.WriteLine("\nHeres how the game works:");
            Console.WriteLine("\nOut of the players, the one with the highest value card wins.");
            Console.WriteLine("Goodluck !");

            Console.Write("\nEnter the number of players: ");
            int numPlayers;
            while (true)
            {
                numPlayers = int.Parse(Console.ReadLine());
                if (numPlayers >= 2)
                {
                    break;
                }
                Console.ForegroundColor = ConsoleColor.Red;
                Console.WriteLine("Bro, you need at least  2 players..");
                Console.ResetColor();
                Console.Write("Enter the number of players: ");
            }

            Game game = new Game(numPlayers);
            game.Play();

            Console.WriteLine("Press any key to exit...");
            Console.ReadKey();
        }
    }
}