using System;
using System.Text;
using System.Collections.Generic;

namespace SimpleCard
{
    public class Player
    {
        public string Name { get; }
        public List<Card> Hand { get; }
        public int Score { get; private set; }
        public bool IsHuman { get; }

        public Player(string name, bool isHuman = true)
        {
            Name = name;
            Hand = new List<Card>();
            IsHuman = isHuman;
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

        public virtual Card GetCard()
        {
            if (IsHuman)
            {
                // Human player logic
                
                for (int i = 0; i < Hand.Count; i++)
                {
                    Console.WriteLine($"{i + 1}: {Hand[i]}");
                }

                int selectedIndex = -1;
                while (selectedIndex < 0 || selectedIndex >= Hand.Count)
                {
                    Console.Write("Enter the index of the card you want to play: ");
                    if (int.TryParse(Console.ReadLine(), out int index))
                    {
                        selectedIndex = index - 1;
                    }
                }

                Card selectedCard = Hand[selectedIndex];
                RemoveCard(selectedCard);
                return selectedCard;
            }
            else
            {
                // Computer player logic
                Random random = new Random();
                int selectedIndex = random.Next(Hand.Count);
                Card selectedCard = Hand[selectedIndex];
                RemoveCard(selectedCard);
                return selectedCard;
            }
        }

        public override string ToString()
        {
            StringBuilder sb = new StringBuilder();
            sb.AppendLine($"{Name}, your cards are:");
            foreach (Card card in Hand)
            {
                sb.AppendLine($"- {card.ToString()}");
            }
            return sb.ToString();
        }
    }

}

