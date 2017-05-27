/** 
 * Class to manage the Subject objects
 * @bornDate Subject.js
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: ID of the user
        * bornDate: Subject's bornDate
        * gender: Subject's gender
        * breed: Subject's breed
        * nick: Subject's nick
        * bloodType: Subject's bloodType number
        * status: Subject's status
        * height: Subject's height
        * weight: Subject's weight
        * countryId: Subject's countryId ID 
        * user: Subject's user object
*/
function Subject()
{
    //Atributes
    this.id;
    this.bornDate;
    this.gender;
    this.breed;
    this.nick;
    this.bloodType;
    this.status;
    this.height;
    this.weight;
    this.countryId;
    this.user;
    
    //Constructor
    this.construct = function (id, bornDate, gender, breed, nick, bloodType, status, height, weight, countryId, user)
    {
        this.setId(id);
        this.setBornDate(bornDate);
        this.setGender(gender);
        this.setBreed(breed);
        this.setNick(nick);
        this.setBloodType(bloodType);
        this.setStatus(status);
        this.setHeight(height);
        this.setWeight(weight);
        this.setCountryId(countryId);
        this.setUser(user);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setBornDate = function (bornDate) {this.bornDate=bornDate;}
    this.setGender = function (gender) {this.gender=gender;}
    this.setBreed = function (breed) {this.breed=breed;}
    this.setNick = function (nick) {this.nick=nick;}
    this.setBloodType = function (bloodType) {this.bloodType=bloodType;}
    this.setStatus = function (status) {this.status=status;}
    this.setHeight = function (height) {this.height=height;}
    this.setWeight = function (weight) {this.weight=weight;}
    this.setCountryId = function (countryId) {this.countryId=countryId;}
    this.setUser = function (user) {this.user=user;}
    //
    this.getId = function () {return this.id;}
    this.getBornDate = function () {return this.bornDate;}    
    this.getGender = function () {return this.gender;}
    this.getBreed = function () {return this.breed;}
    this.getNick = function () {return this.nick;}
    this.getBloodType = function () {return this.bloodType;}
    this.getStatus = function () {return this.status;}   
    this.getHeight = function () {return this.height;}   
    this.getWeight = function () {return this.weight;}   
    this.getCountryId = function () {return this.countryId;}
    this.getUser = function () {return this.user;}
}