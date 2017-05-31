/** 
 * Class to manage the Statistics objects
 * @name Statistics.js
 * @author Jonathan Lozano
 * @date 2017-05-15
 * @version 1.0
 * @param 
    project: ID of the phase
    subject: Statistics's subject object
    subject: Statistics's subject object
    session: Statistics's session object
    phase: Statistics's phase object
*/
function Statistics()
{
    //Atributes
    this.project;
    this.subject;
    this.session;
    this.phase;
    
    //Constructor
    this.construct = function (project, subject, session, phase)
    {
        this.setProject(project);
        this.setSubject(subject);
        this.setSession(session);
        this.setPhase(phase);
    }
    
    //Getters & Setters
    this.setProject = function (project) {this.project=project;}
    this.setSubject = function (subject) {this.subject=subject;}
    this.setSession = function (session) {this.session=session;}
    this.setPhase = function (phase) {this.phase=phase;}
    //
    this.getProject = function () {return this.project;}
    this.getSubject = function () {return this.subject;}    
    this.getSession = function () {return this.session;}    
    this.getPhase = function () {return this.phase;}    
}