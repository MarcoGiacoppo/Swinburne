using NUnit.Framework;

namespace TestClockClass
{
    public class TestClock
    {
        Clock myClock;
        [SetUp]
        public void Setup()
        {
            myClock = new Clock();
        }


        [Test]
        public void Tick30s()
        {
            for (int i = 0; i < 30; i++)
            {
                myClock.Tick();
            }
            Assert.That(myClock.Time, Is.EqualTo("00:00:30"));
        }

        [Test]
        public void Tick60s()
        {
            for (int i = 0; i < 60; i++)
            {
                myClock.Tick();
            }
            Assert.That(myClock.Time, Is.EqualTo("00:01:00"));
        }

        [Test]
        public void Tick1hr()
        {
            for (int i = 0; i < 3600; i++)
            {
                myClock.Tick();
            }
            Assert.That(myClock.Time, Is.EqualTo("01:00:00"));
        }

        [Test]
        public void Tick24hrs()
        {
            for (int i = 0; i < 86400; i++)
            {
                myClock.Tick();
            }
            Assert.That(myClock.Time, Is.EqualTo("00:00:00"));
        }

        [Test]
        public void TestReset()
        {
            for (int i = 0; i < 420; i++)
            {
                myClock.Tick();
            }
            myClock.Reset();
            Assert.That(myClock.Time, Is.EqualTo("00:00:00"));
        }

    }
}
