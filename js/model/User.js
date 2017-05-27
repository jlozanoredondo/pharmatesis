/** 
 * Class to manage the User objects
 * @name User.js
 * @author Joan Fernández
 * @date 2017-02-23
 * @version 1.0
 * @param id: ID of the user
        * name: User's name
        * password: User's password
        * surnames: User's surnames
        * email: User's email
        * phone: User's phone number
        * bornDate: User's born date
        * specialism: User's specialism
        * professionId: User's profession ID (relation with Profession)
*/
function User()
{
    //Atributes
    this.id;
    this.name;
    this.password;
    this.surnames;
    this.email;
    this.phone;
    this.bornDate;
    this.specialism;
    this.professionId;
    
    //Constructor
    this.construct = function (id, name, password, surnames, email, phone, bornDate, specialism, professionId)
    {
        this.setId(id);
        this.setName(name);
        this.setPassword(password);
        this.setSurnames(surnames);
        this.setEmail(email);
        this.setPhone(phone);
        this.setBornDate(bornDate);
        this.setSpecialism(specialism);
        this.setProfessionId(professionId);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setName = function (name) {this.name=name;}
    this.setPassword = function (password) {this.password=password;}
    this.setSurnames = function (surnames) {this.surnames=surnames;}
    this.setEmail = function (email) {this.email=email;}
    this.setPhone = function (phone) {this.phone=phone;}
    this.setBornDate = function (bornDate) {this.bornDate=bornDate;}
    this.setSpecialism = function (specialism) {this.specialism=specialism;}
    this.setProfessionId = function (professionId) {this.professionId=professionId;}
    //
    this.getId = function () {return this.id;}
    this.getName = function () {return this.name;}    
    this.getPassword = function () {return this.password;}
    this.getSurnames = function () {return this.surnames;}
    this.getEmail = function () {return this.email;}
    this.getPhone = function () {return this.phone;}
    this.getBornDate = function () {return this.bornDate;}
    this.getSpecialism = function () {return this.specialism;}   
    this.getProfessionId = function () {return this.professionId;}
}