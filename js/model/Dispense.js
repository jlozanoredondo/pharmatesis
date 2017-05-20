/** 
 * Class to manage the Dispense objects
 * @subject Dispense.js
 * @author Jonathan Lozano
 * @date 2017-05-15
 * @version 1.0
 * @param id: ID of the project
        * projectId: Dispense's projectId
        * subject: Subject object
        * phaseId: Dispense's initial date
        * sessionId: Dispense's end date
        * viability: Dispense's tested drug
        * sideEffects: Dispense's sideEffects object (relation with SideEffects)
        * sideEffects: Dispense's sideEffects object (relation with SideEffects)
*/
function Dispense()
{
    //Atributes
    this.id;
    this.projectId;
    this.subject;
    this.phaseId;
    this.sessionId;
    this.viability;
    this.sideEffects;
    this.dose;
    this.reaction;
    
    //Constructor
    this.construct = function (id, projectId, subject, phaseId, sessionId, viability, sideEffects, dose, reaction)
    {
        this.setId(id);
        this.setProjectId(projectId);
        this.setSubject(subject);
        this.setPhaseId(phaseId);
        this.setSessionId(sessionId);
        this.setViability(viability);
        this.setSideEffects(sideEffects);
        this.setDose(dose);
        this.setReaction(reaction);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setProjectId = function (projectId) {this.projectId=projectId;}
    this.setSubject = function (subject) {this.subject=subject;}
    this.setPhaseId = function (phaseId) {this.phaseId=phaseId;}
    this.setSessionId = function (sessionId) {this.sessionId=sessionId;}
    this.setViability = function (viability) {this.viability=viability;}
    this.setSideEffects = function (sideEffects) {this.sideEffects=sideEffects;}
    this.setDose = function (dose) {this.dose=dose;}
    this.setReaction = function (reaction) {this.reaction=reaction;}
    //
    this.getId = function () {return this.id;}
    this.getProjectId = function () {return this.projectId;}    
    this.getSubject = function () {return this.subject;}    
    this.getPhaseId = function () {return this.phaseId;}
    this.getSessionId = function () {return this.sessionId;}
    this.getViability = function () {return this.viability;}
    this.getSideEffects = function () {return this.sideEffects;}
    this.getDose = function () {return this.dose;}
    this.getReaction = function () {return this.reaction;}
}