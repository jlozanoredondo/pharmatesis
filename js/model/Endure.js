/** 
 * Class to manage the Endure objects
 * @name Endure.js
 * @author Jonathan Lozano
 * @date 2017-05-16
 * @version 1.0
 * @param 
    id: ID of the phase
    subject: Endure's subject object
    disease: Endure's disease object
*/
function Endure()
{
    //Atributes
    this.id;
    this.subject;
    this.disease;
    
    //Constructor
    this.construct = function (id, subject, disease)
    {
        this.setId(id);
        this.setSubject(subject);
        this.setDisease(disease);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setSubject = function (subject) {this.subject=subject;}
    this.setDisease = function (disease) {this.disease=disease;}
    //
    this.getId = function () {return this.id;}
    this.getSubject = function () {return this.subject;}    
    this.getDisease = function () {return this.disease;}    
}