/** 
 * Class to manage the Profession objects
 * @name Profession.js
 * @author Joan Fernández
 * @date 2017-03-09
 * @version 1.0
 * @param 
    id: ID of the profession
    name: Profession's name object
*/
function Profession()
{
    //Atributes
    this.id;
    this.name;
    
    //Constructor
    this.construct = function (id, name)
    {
        this.setId(id);
        this.setName(name);        
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setName = function (name) {this.name=name;}    
    //
    this.getId = function () {return this.id;}
    this.getName = function () {return this.name;}
}