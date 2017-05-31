/** 
 * Class to manage the Project objects
 * @name Project.js
 * @author Jonathan Lozano
 * @date 2017-05-15
 * @version 1.0
 * @param 
    id: ID of the project
    userId: Project's userId
    name: Project's name
    initialDate: Project's initial date
    endDate: Project's end date
    testedDrug: Project's tested drug
    disease: Project's disease object
*/
function Project()
{
    //Atributes
    this.id;
    this.userId;
    this.name;
    this.initialDate;
    this.endDate;
    this.testedDrug;
    this.disease;
    
    //Constructor
    this.construct = function (id, userId, name, initialDate, endDate, testedDrug, disease)
    {
        this.setId(id);
        this.setUserId(userId);
        this.setName(name);
        this.setInitialDate(initialDate);
        this.setEndDate(endDate);
        this.setTestedDrug(testedDrug);
        this.setDisease(disease);
    }
    
    //Getters & Setters
    this.setId = function (id) {this.id=id;}
    this.setUserId = function (userId) {this.userId=userId;}
    this.setName = function (name) {this.name=name;}
    this.setInitialDate = function (initialDate) {this.initialDate=initialDate;}
    this.setEndDate = function (endDate) {this.endDate=endDate;}
    this.setTestedDrug = function (testedDrug) {this.testedDrug=testedDrug;}
    this.setDisease = function (disease) {this.disease=disease;}
    //
    this.getId = function () {return this.id;}
    this.getUserId = function () {return this.userId;}    
    this.getName = function () {return this.name;}    
    this.getInitialDate = function () {return this.initialDate;}
    this.getEndDate = function () {return this.endDate;}
    this.getTestedDrug = function () {return this.testedDrug;}
    this.getDisease = function () {return this.disease;}
}