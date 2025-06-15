using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;


namespace ClockClass
{
    public class Clock
    {
        private Counter _secs;
        private Counter _mins;
        private Counter _hrs;

        public Clock()
        {
            _secs = new Counter("seconds");
            _mins = new Counter("minutes");
            _hrs = new Counter("hours");
        }


        public void Tick()
        {
            _secs.Increment();
            if (_secs.Ticks > 59)
            {
                _mins.Increment();
                _secs.Reset();
            }
            if (_mins.Ticks > 59)
            {
                _hrs.Increment();
                _mins.Reset();
            }
            if (_hrs.Ticks > 23)
            {
                _hrs.Reset();
                _mins.Reset();
                _secs.Reset();
            }
        }

        public void Reset()
        {
            _hrs.Reset();
            _mins.Reset();
            _secs.Reset();
        }

        public string Time
        {
            get
            {
                return
                    $"{_hrs.Ticks:00}:{_mins.Ticks:00}:{_secs.Ticks:00}";
            }
        }
    }
}
