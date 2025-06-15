using System;
namespace SimpleCard
{
    public class ComputerPlayer : Player
    {
        private static readonly Random random = new Random();

       

        public ComputerPlayer(string name) : base(name, false)
        {
        }

        public override Card GetCard()
        {
            List<Card> hand = Hand;
            int selectedIndex = random.Next(hand.Count);
            Card selectedCard = hand[selectedIndex];
            RemoveCard(selectedCard);
            Console.WriteLine($"\nComputer player played: {selectedCard}");
            return selectedCard;
        }

    }
}

