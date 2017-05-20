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
        * countryId: Subject's profession ID (relation with Profession)
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
    this.countryId;
    
    //Constructor
    this.construct = function (id, bornDate, gender, breed, nick, bloodType, status, countryId)
    {
        this.setId(id);
        this.setBornDate(bornDate);
        this.setGender(gender);
        this.setBreed(breed);
        this.setNick(nick);
        this.setBloodType(bloodType);
        this.setStatus(status);
        this.setCountryId(countryId);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setBornDate = function (bornDate) {this.bornDate=bornDate;}
    this.setGender = function (gender) {this.gender=gender;}
    this.setBreed = function (breed) {this.breed=breed;}
    this.setNick = function (nick) {this.nick=nick;}
    this.setBloodType = function (bloodType) {this.bloodType=bloodType;}
    this.setStatus = function (status) {this.status=status;}
    this.setCountryId = function (countryId) {this.countryId=countryId;}
    //
    this.getId = function () {return this.id;}
    this.getBornDate = function () {return this.bornDate;}    
    this.getGender = function () {return this.gender;}
    this.getBreed = function () {return this.breed;}
    this.getNick = function () {return this.nick;}
    this.getBloodType = function () {return this.bloodType;}
    this.getStatus = function () {return this.status;}   
    this.getCountryId = function () {return this.countryId;}
}