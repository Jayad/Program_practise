#include<string>
#include <iostream>
using namespace std;
 
class Car //Our Abstract base class
{
        protected:
                string _str;
        public:
                Car()
                {
                        _str = "Unknown Car";
                }
 
                virtual string getDescription()
                {       
                        return _str;
                }
 
                virtual double getCost() = 0;
 
                virtual ~Car(){cout<<"~Car()"<<endl;}
};
 
class OptionsDecorator : public Car //Decorator Base class
{
        public:
                virtual string getDescription() =0;
 
                virtual ~OptionsDecorator()
                {
                        cout<<"~OptionsDecorator ()"<<endl;
                }
};
 
 
class CarModel1 : public Car
{       
                Car *b;
 
        public:
                CarModel1()
                {
                        _str = "CarModel1";
                }
                virtual double getCost()
                {
                        return 31000.23;
                }
 
                ~CarModel1()
                {
                        cout<<"~CarModel1()"<<endl;
                }
};
 
 
class Navigation: public OptionsDecorator
{
                Car *_b;
        public:
                Navigation(Car *b)
                {
                        _b = b;
                }
                string getDescription()
                {
                        return _b->getDescription() + ", Navigation";
                }
 
                double getCost()
                {
                        return 300.56 + _b->getCost();
                }
                ~Navigation()
                {
                        cout<<"~Navigation()"<<endl;
                }
};
 
class PremiumSoundSystem: public OptionsDecorator
{
                Car *_b;
        public:
                PremiumSoundSystem(Car *b)
                {
                        _b = b;
                }
                string getDescription()
                {
                        return _b->getDescription() + ", PremiumSoundSystem";
                }
 
                double getCost()
                {
                        return 0.30 + _b->getCost();
                }
                ~PremiumSoundSystem()
                {
                        cout<<"~PremiumSoundSystem()"<<endl;
                }
};
 
class ManualTransmition: public OptionsDecorator
{
                Car *_b;
        public:
                ManualTransmition(Car *b)
                {
                        _b = b;
                }
                string getDescription()
                {
                                        return _b->getDescription()+ ", Soy Milk";
                }
 
                double getCost()
                {
                        return 0.30 + _b->getCost();
                }
                ~ManualTransmition()
                {
                        cout<<"~ManualTransmition()"<<endl;
                }
};
 
class CarDecoratorExample
{
        public:
 
        void execute()
        {
            //Create our Car that we want to buy
                Car *b = new CarModel1();
 
            cout<<"Base model of "<< b->getDescription() <<" costs $"<<b->getCost()<<endl;  
 
            //Who wants base model lets add some more features
 
            b = new Navigation(b);
            cout<<b->getDescription()<<" will cost you $"<<b->getCost()<<endl;
            b = new PremiumSoundSystem(b);
            b = new ManualTransmition(b);
            cout<<b->getDescription()<<" will cost you $"<<b->getCost()<<endl;
 
 
            delete b;
        }
 
    };
 
 
int main()
{
        CarDecoratorExample b;
        b.execute();
        return 0;
}


