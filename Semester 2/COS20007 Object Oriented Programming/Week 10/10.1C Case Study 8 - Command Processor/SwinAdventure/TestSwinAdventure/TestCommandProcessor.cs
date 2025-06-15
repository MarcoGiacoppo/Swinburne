using SwinAdventure;
using System.Numerics;
using Path = SwinAdventure.Path;

namespace SwinAdventureTest
{
    [TestFixture]
    public class CommandProcessorTests
    {
        CommandProcessor command;
        Location location;
        Location destination;
        Path path;
        Player player;
        Item knife;


        [SetUp]
        public void Setup()
        {
            command = new();
            location = new Location("a jungle", "This is a creepy jungle");
            destination = new Location("a tower", "This is a tilted tower");
            path = new Path(new string[] { "south" }, "south", "this is south", destination);
            player = new Player("bob", "the builder");
            knife = new Item(new string[] { "Knife" }, "a sharp knife", "This is a sharp knife");

            player.Location = location;
            location.AddPath(path);
        }

        [Test]
        public void TestLookAtNone()
        {
            string actual = command.Execute(player, new string[] { "look", "at", "none" });
            string expected = "I can't find the none";            
            Assert.That(actual, Is.EqualTo(expected));
        }
        [Test]
        public void TestLookAtInventory()
        {
            string actual = command.Execute(player, new string[] { "look", "at", "inventory" });
            string expected = "You are bob, the builder.\nYou are carrying:\n";            
            Assert.That(actual, Is.EqualTo(expected));
        }
        [Test]
        public void TestLookAtKnife()
        {
            player.Inventory.Put(knife);
            string actual = command.Execute(player, new string[] { "look", "at", "knife" });
            Assert.That(actual, Is.EqualTo(knife.FullDescription));
        }
        [Test]
        public void TestNoSmile()
        {
            string actual = command.Execute(player, new string[] { "smile" });
            string expected = "I don't know how to smile.";            
            Assert.That(actual, Is.EqualTo(expected));
        }
        [Test]
        public void TestMove()
        {
            Assert.That(player.Location, Is.SameAs(location));
            string actual = command.Execute(player, new string[] { "move", "south" });
            Assert.That(player.Location, Is.SameAs(destination));
        }
        [Test]
        public void TestInvalidMove()
        {
            Assert.That(player.Location, Is.SameAs(location));
            string actual = command.Execute(player, new string[] { "move", "north" });
            Assert.That(player.Location, Is.SameAs(location));
        }
        [Test]
        public void TestInvalidDirection()
        {
            string actual = command.Execute(player, new string[] { "move", "west" });
            string expected = "Error in direction!";
            Assert.That(actual, Is.EqualTo(expected));
        }
    }
}