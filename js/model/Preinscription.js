/** 
 * Class to manage the Preinscription objects
 * @name Preinscription.js
 * @author Jonathan Lozano
 * @date 2017-05-15
 * @version 1.0
 * @param 
    id: ID of the phase
    subject: Preinscription's subject object
    medicament: Preinscription's medicament object
*/
function Preinscription()
{
    //Atributes
    this.id;
    this.subject;
    this.medicament;
    
    //Constructor
    this.construct = function (id, subject, medicament)
    {
        this.setId(id);
        this.setSubject(subject);
        this.setMedicament(medicament);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setSubject = function (subject) {this.subject=subject;}
    this.setMedicament = function (medicament) {this.medicament=medicament;}
    //
    this.getId = function () {return this.id;}
    this.getSubject = function () {return this.subject;}    
    this.getMedicament = function () {return this.medicament;}    
}