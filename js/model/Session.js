/** 
 * Class to manage the Session objects
 * @name Session.js
 * @author Jonathan Lozano
 * @date 2017-05-15
 * @version 1.0
 * @param 
    id: ID of the session
    name: Session's name
    date: Session's date
    endDate: Session's end date
*/
function Session()
{
    //Atributes
    this.id;
    this.name;
    this.date;
    this.endDate;
    
    //Constructor
    this.construct = function (id, name, date, endDate)
    {
        this.setId(id);
        this.setName(name);
        this.setDate(date);
        this.setEndDate(endDate);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setName = function (name) {this.name=name;}
    this.setDate = function (date) {this.date=date;}
    this.setEndDate = function (endDate) {this.endDate=endDate;}
    //
    this.getId = function () {return this.id;}
    this.getName = function () {return this.name;}    
    this.getDate = function () {return this.date;}    
    this.getEndDate = function () {return this.endDate;}    
}