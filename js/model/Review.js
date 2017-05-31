/** 
 * Class to manage the Phase objects
 * @name Phase.js
 * @author Joan Fernández
 * @date 2017-03-09
 * @version 1.0
 * @param 
    name: Name of the user that sends the review
    email: Email of the user that sends the review
    comments: Comments of review
*/
function Review()
{
    //Atributes
    this.name;
    this.email;
    this.comments;
    
    //Constructor
    this.construct = function (name, email, comments)
    {
        this.setName(name);
        this.setEmail(email);
        this.setComments(comments);
    }
    
    //Getters & Setters
    this.setName = function (name) {this.name=name;}
    this.setEmail = function (email) {this.email=email;}
    this.setComments = function (comments) {this.comments=comments;}
    //
    this.getName = function () {return this.name;}
    this.getEmail = function () {return this.email;}
    this.getComments = function () {return this.comments;}
}