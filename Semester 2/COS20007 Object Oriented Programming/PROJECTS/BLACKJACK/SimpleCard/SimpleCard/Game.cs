using System;
using System.Collections.Generic;
using SimpleCard;

namespace Blackjack
{
    public class Game
    {
        public Deck Deck { get; }
        public List<Player> Players { get; }

        public Game(List<string> playerNames)
        {
            Deck = new Deck();
            Deck.Shuffle();
            Players = new List<Player>();

            foreach (string name in playerNames)
            {
                Players.Add(new Player(name, this));
            }
        }

        public void Play()
        {
            // Deal two cards to each player
            foreach (Player player in Players)
            {
                player.AddCard(Deck.Draw());
                player.AddCard(Deck.Draw());
            }

            // Loop through each player and give them a chance to play
            foreach (Player player in Players)
            {
                while (!player.IsBust())
                {
                    Console.Clear();
                    Console.WriteLine(player.ToString());

                    // Get the player's next move
                    Card playedCard = player.GetCard(true);

                    // If the player didn't bust or win, move on to the next player
                    if (!player.IsBust() && player.GetHandValue() != 21)
                    {
                        Console.WriteLine("Press enter to continue...");
                        Console.ReadLine();
                        break;
                    }
                }
            }

            // Determine the winner(s)
            List<Player> winners = new List<Player>();
            int highestScore = 0;

            foreach (Player player in Players)
            {
                if (!player.IsBust())
                {
                    int playerScore = player.GetHandValue();

                    if (playerScore > highestScore)
                    {
                        highestScore = playerScore;
                        winners.Clear();
                        winners.Add(player);
                    }
                    else if (playerScore == highestScore)
                    {
                        winners.Add(player);
                    }
                }
            }

            // Print out the winner(s)
            Console.Clear();

            if (winners.Count == 0)
            {
                Console.WriteLine("No winner!");
            }
            else if (winners.Count == 1)
            {
                Console.WriteLine($"{winners[0].Name} wins with a score of {winners[0].GetHandValue()}!");
            }
            else
            {
                Console.WriteLine("Tie between:");
                foreach (Player player in winners)
                {
                    Console.WriteLine($"- {player.Name} with a score of {player.GetHandValue()}");
                }
            }

            
            Console.ReadLine();
        }
    }
}
