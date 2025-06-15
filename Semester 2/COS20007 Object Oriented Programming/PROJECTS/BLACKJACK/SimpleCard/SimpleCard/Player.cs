using System;
using System.Collections.Generic;
using Blackjack;

namespace SimpleCard
{
    public class Player
    {
        public string Name { get; }
        public List<Card> Hand { get; }
        public int Score { get; private set; }
        public Game GameInstance { get; }

        public Player(string name, Game game)
        {
            Name = name;
            Hand = new List<Card>();
            GameInstance = game;
        }

        public void AddCard(Card card)
        {
            Hand.Add(card);
        }

        public void RemoveCard(Card card)
        {
            Hand.Remove(card);
        }

        public void IncrementScore()
        {
            Score++;
        }

        public bool isBust()
        {
            return GetHandValue() > 21;
        }

        public int GetHandValue()
        {
            int handValue = 0;
            int numAces = 0;

            foreach (Card card in Hand)
            {
                if (card.Rank == Rank.Ace)
                {
                    numAces++;
                    handValue += 11;
                }
                else if (card.Rank == Rank.Jack || card.Rank == Rank.Queen || card.Rank == Rank.King)
                {
                    handValue += 10;
                }
                else
                {
                    handValue += (int)card.Rank;
                }
            }

            while (numAces > 0 && handValue > 21)
            {
                handValue -= 10;
                numAces--;
            }

            return handValue;
        }

        public virtual bool GetCard(bool isHuman)
        {
            bool hasBusted = false;

            if (isHuman)
            {
                // Human player logic
                bool done = false;
                while (!done)
                {
                    Console.Write("Do you want to hit (H) or stand (S)? ");
                    string input = Console.ReadLine().ToLower();

                    if (input == "h")
                    {
                        // Deal a new card and check for bust
                        Card newCard = GameInstance.Deck.Draw();
                        Console.WriteLine($"You drew a {newCard}.");
                        AddCard(newCard);
                        int handValue = GetHandValue();

                        if (handValue > 21)
                        {
                            Console.WriteLine("Bust! You lose.");
                            hasBusted = true;
                            done = true;
                        }
                        else if (handValue == 21)
                        {
                            Console.WriteLine("21! You Win!");
                            done = true;
                        }
                    }
                    else if (input == "s")
                    {
                        done = true;
                    }
                    else
                    {
                        Console.WriteLine("Invalid input. Please enter 'H' or 'S'.");
                    }
                }

                if (hasBusted)
                {
                    // Display the player's hand value if they bust
                    Console.WriteLine($"{Name}, your hand value is {GetHandValue()}. You busted.");
                }
            }
            else
            {
                // Computer player logic
                Random random = new Random();
                int selectedIndex = random.Next(Hand.Count);
                Card selectedCard = Hand[selectedIndex];
                RemoveCard(selectedCard);
            }

            return hasBusted;
        }
        public override string ToString()
        {
            return $"{Name}, your cards are:\n{string.Join("\n", Hand)}\nTotal hand value: {GetHandValue()}";
        }
    }
}


