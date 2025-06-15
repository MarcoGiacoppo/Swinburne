using SimpleCard;


public class Deck
{
    private readonly List<Card> _cards;

    public Deck()
    {
        _cards = new List<Card>();

        foreach (Suit suit in Enum.GetValues(typeof(Suit)))
        {
            foreach (Rank rank in Enum.GetValues(typeof(Rank)))
            {
                _cards.Add(new Card(rank, suit));
            }
        }

        Shuffle();
    }

    // This method shuffles the list of cards using the Fisher-Yates shuffle algorithm
    public void Shuffle()
    {
        Random rng = new Random();
        int n = _cards.Count; 

        while (n > 1) // A loop that will run for each card, starting from the last one
        {
            // The loop repeats for each card in the deck, randomly swapping each card with another card.
            n--;
            int k = rng.Next(n + 1); 
            Card temp = _cards[k]; 
            _cards[k] = _cards[n];
            _cards[n] = temp;
        }
    }

    public Card TakeTopCard()
    {
        Card card = _cards[0];
        _cards.RemoveAt(0);
        return card;
    }
}
