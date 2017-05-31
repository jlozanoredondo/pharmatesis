/** 
 * Class to manage the Phase objects
 * @name Phase.js
 * @author Jonathan Lozano
 * @date 2017-05-15
 * @version 1.0
 * @param 
    id: ID of the phase
    name: Phase's name object
*/
function Phase()
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