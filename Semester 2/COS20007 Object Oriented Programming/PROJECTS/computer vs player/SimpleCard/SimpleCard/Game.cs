using SimpleCard;

public class Game : BaseGame
{
    public Game(int numPlayers) : base(numPlayers)
    {
        for (int i = 0; i < numPlayers; i++)
        {
            Console.Write($"\nEnter player {i + 1}'s name: ");
            string name = Console.ReadLine();

            // Prompt user to choose between human and computer player
            string playerType = "";
            while (playerType != "h" && playerType != "c")
            {
                Console.Write($"Is {name} a Human (h) or a Computer (c)? ");
                playerType = Console.ReadLine().ToLower();
            }
            if (playerType == "c")
            {
                players.Add(new ComputerPlayer(name));
            }
            else
            {
                players.Add(new Player(name));
            }
        }
    }

    public void Play()
    {
        Console.WriteLine("\nWelcome to the card game!");
        Console.WriteLine($"There are {numPlayers} players.");

        deck.Shuffle();

        // Deal three cards to each player
        for (int i = 0; i < numPlayers; i++)
        {
            Player player = players[i];
            for (int j = 0; j < 3; j++)
            {
                player.AddCard(deck.TakeTopCard());
            }
        }

        // Play three rounds
        for (int round = 1; round <= 3; round++)
        {
            Console.WriteLine($"\nRound {round}\n");

            // Display each player's cards
            foreach (Player player in players)
            {
                Console.WriteLine($"{player.Name}, your cards are:");
                foreach (Card card in player.Hand)
                {
                    Console.WriteLine($"- {card.ToString()}");
                }
                Console.WriteLine();
            }

            // Play the round
            int winningPlayerIndex = -1;
            for (int j = 0; j < numPlayers; j++)
            {
                Player player = players[j];
                Console.Write($"\n{player.Name}, it's your turn. Play a card:\n");
                Card playedCard = player.GetCard();
                player.RemoveCard(playedCard);
                cardsInPlay.Add(playedCard);

                if (winningPlayerIndex == -1 || playedCard.CompareTo(cardsInPlay[winningPlayerIndex]) > 0)
                {
                    winningPlayerIndex = j;
                }
            }

            // Determine the round winner
            Player roundWinner = players[winningPlayerIndex];
            Console.ForegroundColor = ConsoleColor.Green;
            Console.WriteLine($"\nThe winner of this round is {roundWinner.Name}!\n");
            Console.ResetColor();
            roundWinner.IncrementScore();

            // Clear the cards in play for the next round
            cardsInPlay.Clear();
        }

        // Display final scores and determine the winner
        Console.WriteLine("The game is over! Final scores:\n");
        int maxScore = 0;
        Player winner = null;
        bool draw = false;

        foreach (Player player in players)
        {
            int score = player.Score;
            Console.WriteLine($"{player.Name}: {score} point{(score == 1 ? "" : "s")}");

            if (score > maxScore)
            {
                maxScore = score;
                winner = player;
                draw = false;
            }
            else if (score == maxScore)
            {
                draw = true;
            }
        }

        if (draw)
        {
            Console.WriteLine("\nThe game is a draw!");
        }
        else
        {
            Console.ForegroundColor = ConsoleColor.Green;
            Console.WriteLine($"\n{winner.Name} wins! Congratulations!");
            Console.ResetColor();
        }

    }

}
