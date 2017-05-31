/** 
 * Class to manage the Dispense objects
 * @subject Dispense.js
 * @author Jonathan Lozano
 * @date 2017-05-15
 * @version 1.0
 * @param 
    id: ID of the project
    project: Dispense's project object
    subject: Subject object
    phase: Dispense's phase object
    session: Dispense's session object
    viability: Dispense's viability
    sideEffects: Dispense's sideEffects object
    dose: Dispense's dose 
    reaction: Dispense's reaction 
*/
function Dispense()
{
    //Atributes
    this.id;
    this.project;
    this.subject;
    this.phase;
    this.session;
    this.viability;
    this.sideEffects;
    this.dose;
    this.reaction;
    
    //Constructor
    this.construct = function (id, project, viability, sideEffects, dose, reaction)
    {
        this.setId(id);
        this.setProject(project);
        this.setViability(viability);
        this.setSideEffects(sideEffects);
        this.setDose(dose);
        this.setReaction(reaction);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setProject = function (project) {this.project=project;}
    this.setSubject = function (subject) {this.subject=subject;}
    this.setPhase = function (phase) {this.phase=phase;}
    this.setSession = function (session) {this.session=session;}
    this.setViability = function (viability) {this.viability=viability;}
    this.setSideEffects = function (sideEffects) {this.sideEffects=sideEffects;}
    this.setDose = function (dose) {this.dose=dose;}
    this.setReaction = function (reaction) {this.reaction=reaction;}
    //
    this.getId = function () {return this.id;}
    this.getProject = function () {return this.project;}    
    this.getSubject = function () {return this.subject;}    
    this.getPhase = function () {return this.phase;}
    this.getSession = function () {return this.session;}
    this.getViability = function () {return this.viability;}
    this.getSideEffects = function () {return this.sideEffects;}
    this.getDose = function () {return this.dose;}
    this.getReaction = function () {return this.reaction;}
}