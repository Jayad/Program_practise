class CPrototypeMonster
 {
 protected:            
     CString           _name;
 public:
     CPrototypeMonster();
     CPrototypeMonster( const CPrototypeMonster& copy );
     virtual ~CPrototypeMonster();
 
     virtual CPrototypeMonster*    Clone() const=0; // This forces every derived class to provide an overload for this function.
     void        Name( CString name );
     CString    Name() const;
 };
 
 class CGreenMonster : public CPrototypeMonster
 {
 protected: 
     int         _numberOfArms;
     double      _slimeAvailable;
 public:
     CGreenMonster();
     CGreenMonster( const CGreenMonster& copy );
     ~CGreenMonster();
 
     virtual CPrototypeMonster*    Clone() const;
     void  NumberOfArms( int numberOfArms );
     void  SlimeAvailable( double slimeAvailable );
 
     int         NumberOfArms() const;
     double      SlimeAvailable() const;
 };
 
 class CPurpleMonster : public CPrototypeMonster
 {
 protected:
     int         _intensityOfBadBreath;
     double      _lengthOfWhiplikeAntenna;
 public:
     CPurpleMonster();
     CPurpleMonster( const CPurpleMonster& copy );
     ~CPurpleMonster();
 
     virtual CPrototypeMonster*    Clone() const;
 
     void  IntensityOfBadBreath( int intensityOfBadBreath );
     void  LengthOfWhiplikeAntenna( double lengthOfWhiplikeAntenna );
 
     int       IntensityOfBadBreath() const;
     double    LengthOfWhiplikeAntenna() const;
 };
 
 class CBellyMonster : public CPrototypeMonster
 {
 protected:
     double      _roomAvailableInBelly;
 public:
     CBellyMonster();
     CBellyMonster( const CBellyMonster& copy );
     ~CBellyMonster();
 
     virtual CPrototypeMonster*    Clone() const;
 
     void       RoomAvailableInBelly( double roomAvailableInBelly );
     double     RoomAvailableInBelly() const;
 };
 
 CPrototypeMonster* CGreenMonster::Clone() const
 {
     return new CGreenMonster(*this);
 }
 
 CPrototypeMonster* CPurpleMonster::Clone() const
 {
     return new CPurpleMonster(*this);
 }
 
 CPrototypeMonster* CBellyMonster::Clone() const
 {
     return new CBellyMonster(*this);
 }
