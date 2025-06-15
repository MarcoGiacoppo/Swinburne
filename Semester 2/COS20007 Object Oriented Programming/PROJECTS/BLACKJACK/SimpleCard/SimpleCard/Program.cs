using Blackjack;

class Program
{
    static void Main(string[] args)
    {
        Console.WriteLine("Welcome To The BlackJack Game! ");
        // Get player names from user input
        Console.Write("Enter number of players: ");
        int numPlayers = int.Parse(Console.ReadLine());

        List<string> playerNames = new List<string>();
        for (int i = 1; i <= numPlayers; i++)
        {
            Console.Write($"Enter name of player {i}: ");
            playerNames.Add(Console.ReadLine());
        }

        // Create a new game with the player names
        Game game = new Game(playerNames);

        // Play the game
        game.Play();

        // Wait for user input before exiting
        Console.Write("Press any key to exit...");
        Console.ReadKey();
    }
}
