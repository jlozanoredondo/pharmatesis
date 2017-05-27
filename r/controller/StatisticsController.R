"
  @name: StatisticsController.R
  @Author: Jonathan Lozano
  @Version: 1.0
  @Description: Controller to execute R scripts
  @Date: 2017-05-15
"
library("brew")
library("RJSONIO")


#Data reception from local
binpost  <- receiveBin()
inputDataFromLocal <- rawToChar(binpost)

if (isValidJSON(inputDataFromLocal, TRUE)) {
  inputData<-fromJSON(inputDataFromLocal, simplifyWithNames=FALSE)
  "
  inputData$action
  inputData$controllerType
  inputData$jsonData
  "  
  generatedFiles<-c()
  
  setwd("/home/dev/public_html/pharmatesis-app/r/SQLAccess")
  source("SQLAccess.R")
  
  switch (as.character(inputData$action),
          "10000" = {
            
          mydb <- openDB("root", "root", "pharmatesis", "127.0.0.1")
          setwd("/home/dev/public_html/pharmatesis-app/statisticsFiles/graphs/project")
          
          inputData<-fromJSON(inputData$jsonData, simplifyWithNames=FALSE)
          
          projectId <- inputData$id
          
          "GET USERID FROM PROJECT"
          sql <- sprintf("select userId from project where id = %s" ,projectId)
          userId <- execSQLQuery(mydb, sql)
          
          "GET SUBJECT COUNT"
          sql <- sprintf("select count(distinct subjectId) as subjectcount from dispense where projectId = %s" ,projectId)
          subjectsCountProject <- execSQLQuery(mydb, sql)
          
          
          "GET GENDER PROJECT"
          sql <- sprintf("select count(distinct subjectId) as gendercount from subject s, dispense d  where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by s.gender order by count(s.gender)" ,userId,projectId)    
          subjectsGenderCountProject <- execSQLQuery(mydb, sql)
          
          sql <- sprintf("select s.gender from subject s, dispense d  where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by s.gender order by count(s.gender) " ,userId,projectId)    
          subjectsGenderProject <- execSQLQuery(mydb, sql)
          

          png(paste(paste("barplotSubjectsGenderProject",projectId,sep = ""),".png",sep = ""))
          barplot(as.numeric(unlist(subjectsGenderCountProject)),main="Subject's gender"
                  , xlab="", ylab="Occurrences",names.arg = as.matrix(subjectsGenderProject))
          dev.off()
          
          "GET BORN DATE SUBJECT'S PROJECT"
          sql <- sprintf("select bornDate from subject s, dispense d where s.userId = %s and d.projectId = %s and d.subjectId = s.id" ,userId,projectId)    
          subjectsDateProject <- execSQLQuery(mydb, sql)
          
          today <- Sys.Date()
          today<-format(today, format="%Y")
          today<-as.numeric(today)
          for(d in subjectsDateProject){
            year <- strtoi(substring(d,0,4))
            year <- today-year
          }
          
          png(paste(paste("boxPlotYear",projectId,sep = ""),".png",sep = ""))
          boxplot(year,main="Subject's age")
          dev.off() 
          
          "GET Side Effects SUBJECT'S PROJECT"
          
          sql <- sprintf("select count(d.sideEffects) from subject s, dispense d where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by d.sideEffects order by count(d.sideEffects)" ,userId,projectId)    
          dispenseSideEffectsProject <- execSQLQuery(mydb, sql)
          
          sql <- sprintf("select distinct sideEffects from dispense d where d.projectId = %s order by d.sideEffects",projectId)  
          sideEffectsProject <- execSQLQuery(mydb, sql)
          
          
          png(paste(paste("barplotSubjectsSideEffectsProject",projectId,sep = ""),".png",sep = ""))
          barplot(as.numeric(unlist(dispenseSideEffectsProject)),main="Subject's side effects"
                  , xlab="", ylab="Occurrences",names.arg = as.matrix(sideEffectsProject))
          dev.off()
          
          "GET BREED SUBJECT'S PROJECT"
          sql <- sprintf("select count(distinct subjectId) as breedcount from subject s, dispense d  where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by s.breed order by count(s.breed)" ,userId,projectId)    
          subjectsBreedCountProject <- execSQLQuery(mydb, sql)
          
          sql <- sprintf("select s.breed from subject s, dispense d  where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by s.breed order by count(s.breed) " ,userId,projectId)    
          subjectsBreedProject <- execSQLQuery(mydb, sql)
          
          png(paste(paste("barplotSubjectsBreedProject",projectId,sep = ""),".png",sep = ""))
          barplot(as.numeric(unlist(subjectsBreedCountProject)),main="Subject's breed"
                  , xlab="", ylab="Occurrences",names.arg = as.matrix(subjectsBreedProject))
          dev.off()
          
          
          "GET BLOOD TYPE SUBJECT'S PROJECT"
          sql <- sprintf("select count(distinct subjectId) as bloodtypecount from subject s, dispense d  where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by s.bloodType order by count(s.bloodType)" ,userId,projectId)    
          subjectsBreedCountProject <- execSQLQuery(mydb, sql)
          
          sql <- sprintf("select s.bloodType from subject s, dispense d  where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by s.bloodType order by count(s.bloodType) " ,userId,projectId)    
          subjectsBreedProject <- execSQLQuery(mydb, sql)
          
          png(paste(paste("barplotSubjectsBloodTypeProject",projectId,sep = ""),".png",sep = ""))
          barplot(as.numeric(unlist(subjectsBreedCountProject)),main="Subject's blood type"
                  , xlab="", ylab="Occurrences",names.arg = as.matrix(subjectsBreedProject))
          dev.off()
          
          "GET HEIGHT and WEIGHT SUBJECT'S PROJECT"
          sql <- sprintf("select * from subject s, dispense d  where s.userId = %s and d.projectId = %s and d.subjectId = s.id" ,userId,projectId)    
          subjectsBoxPlotProject <- execSQLQuery(mydb, sql)
          
          png(paste(paste("boxPlotSubjectHeight",projectId,sep = ""),".png",sep = ""))
          boxplot(subjectsBoxPlotProject$height,main="Subject's height")
          dev.off()        
          
          png(paste(paste("boxPlotSubjectWeight",projectId,sep = ""),".png",sep = ""))
          boxplot(subjectsBoxPlotProject$weight,main="Subject's weight")
          dev.off()  
          
          "GET viability SUBJECT'S PROJECT"
          
          sql <- sprintf("select count(d.viability) from subject s, dispense d where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by d.viability order by count(d.viability)" ,userId,projectId)    
          dispenseViabilityProject <- execSQLQuery(mydb, sql)
          
          sql <- sprintf("select distinct d.viability from dispense d where d.projectId = %s order by d.viability",projectId)  
          viabilitiesProject <- execSQLQuery(mydb, sql)
          
          png(paste(paste("barplotSubjectsViabilityProject",projectId,sep = ""),".png",sep = ""))
          barplot(as.numeric(unlist(dispenseViabilityProject)),main="Subject's viability"
                  , xlab="", ylab="Occurrences",names.arg = as.matrix(viabilitiesProject))
          dev.off()
          
          "GET reaction SUBJECT'S PROJECT"
          
          sql <- sprintf("select count(d.reaction) from subject s, dispense d where s.userId = %s and d.projectId = %s and d.subjectId = s.id group by d.reaction" ,userId,projectId)    
          dispenseReactionProject <- execSQLQuery(mydb, sql)
          
          sql <- sprintf("select distinct d.reaction from dispense d where d.projectId = %s order by d.reaction",projectId)  
          reactionsProject <- execSQLQuery(mydb, sql)
          
          png(paste(paste("barplotSubjectsReactionProject",projectId,sep = ""),".png",sep = ""))
          barplot(as.numeric(unlist(dispenseReactionProject)),main="Subject's reaction"
                  , xlab="", ylab="Occurrences",names.arg = as.matrix(reactionsProject))
          dev.off()
          
          "GET DOSE SUBJECT'S PROJECT"
          sql <- sprintf("select * from dispense d, subject s where s.userId = %s and d.projectId = %s and d.subjectId = s.id" ,userId,projectId)    
          dispenseBoxPlotProject <- execSQLQuery(mydb, sql)
          
          png(paste(paste("boxPlotProjectDose",projectId,sep = ""),".png",sep = ""))
          boxplot(dispenseBoxPlotProject$dose,main="Subject's dose")
          dev.off()       
          
          
          sql <- sprintf("select * from subject s, dispense d  where s.userId = %s and d.projectId = %s and d.subjectId = s.id" ,userId,projectId)    
          subject <- execSQLQuery(mydb, sql)
          
          sql <- sprintf("select * from dispense d, subject s where s.userId = %s and d.projectId = %s and d.subjectId = s.id" ,userId,projectId)    
          dispense <- execSQLQuery(mydb, sql)
          
          png(paste(paste("boxPlotCorrelationWeightDose",projectId,sep = ""),".png",sep = ""))
          plot(subject$weight, dispense$dose,
               main = "Relationship between subject's dose and weight",
               xlab = "Weight",
               ylab = "Dose")
          abline(lm(dispense$dose ~ subject$weight))
          dev.off()       
          
          png(paste(paste("boxPlotCorrelationHeightDose",projectId,sep = ""),".png",sep = ""))
          plot(subject$height, dispense$dose,
               main = "Relationship between subject's dose and height",
               xlab = "Height",
               ylab = "Dose")
          abline(lm(dispense$dose ~ subject$height))
          dev.off()  
          
          generatedFiles<-list(subjectsCountProject,
             paste("statisticsFiles/graphs/project/",paste(paste("barplotSubjectsSideEffectsProject",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("barplotSubjectsGenderProject",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("barplotSubjectsBreedProject",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("barplotSubjectsBloodTypeProject",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("boxPlotSubjectHeight",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("boxPlotSubjectWeight",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("barplotSubjectsReactionProject",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("boxPlotProjectDose",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("boxPlotCorrelationWeightDose",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("boxPlotCorrelationHeightDose",projectId,sep = ""),".png",sep = ""),sep = ""),
             paste("statisticsFiles/graphs/project/",paste(paste("boxPlotYear",projectId,sep = ""),".png",sep = ""),sep = "")
          )
          },
          "10010" = {
            mydb <- openDB("root", "root", "pharmatesis", "127.0.0.1")
            setwd("/home/dev/public_html/pharmatesis-app/statisticsFiles/graphs/subject/")
            
            inputData<-fromJSON(inputData$jsonData, simplifyWithNames=FALSE)
            
            projectId <- inputData$project$id
            subjectId <- inputData$subject$id
            
            "GET USERID FROM PROJECT"
            sql <- sprintf("select userId from project where id = %s" ,projectId)
            userId <- execSQLQuery(mydb, sql)
            
            "GET DOSE SUBJECT'S PROJECT"
            sql <- sprintf("select * from dispense d, subject s where s.userId = %s and d.projectId = %s and d.subjectId = %s" ,userId,projectId,subjectId)    
            dispenseBoxPlotSubject <- execSQLQuery(mydb, sql)
            
            png(paste(paste("boxPlotSubjectDose",subjectId,sep = ""),".png",sep = ""))
            boxplot(dispenseBoxPlotSubject$dose,main="Subject's dose")
            dev.off()      
            
            generatedFiles<-list(
              paste("statisticsFiles/graphs/subject/",paste(paste("boxPlotSubjectDose",subjectId,sep = ""),".png",sep = ""),sep = "")
              )
          },
          "10020" = {
            mydb <- openDB("root", "root", "pharmatesis", "127.0.0.1")
            setwd("/home/dev/public_html/pharmatesis-app/statisticsFiles/graphs/session/")
            
            inputData<-fromJSON(inputData$jsonData, simplifyWithNames=FALSE)
            
            projectId <- inputData$project$id
            sessionId <- inputData$session$id
            
            file <- paste(projectId,sessionId,sep = "")
            
            "GET USERID FROM PROJECT"
            sql <- sprintf("select userId from project where id = %s" ,projectId)
            userId <- execSQLQuery(mydb, sql)
            
            "GET Side Effects SUBJECT'S SESSION"
            
            sql <- sprintf("select count(d.sideEffects) from dispense d where d.projectId = %s and d.sessionId = %s group by d.sideEffects order by count(d.sideEffects)" ,projectId,sessionId)    
            dispenseSideEffectsSession <- execSQLQuery(mydb, sql)
            
            sql <- sprintf("select distinct sideEffects from dispense d where d.projectId = %s and d.sessionId = %s order by d.sideEffects",projectId,sessionId)  
            sideEffectsSession <- execSQLQuery(mydb, sql)
            
            
            png(paste(paste("barplotSessionSideEffectsSession",file,sep = ""),".png",sep = ""))
            barplot(as.numeric(unlist(dispenseSideEffectsSession)),main="Session's side effects"
                    , xlab="", ylab="Occurrences",names.arg = as.matrix(sideEffectsSession))
            dev.off()
            
            "GET HEIGHT and WEIGHT SUBJECT'S SESSION"
            sql <- sprintf("select * from dispense d, subject s where d.projectId = %s and d.sessionId = %s and d.subjectId = s.id" ,projectId,sessionId)    
            subjectsBoxPlotSession <- execSQLQuery(mydb, sql)
            
            png(paste(paste("boxPlotSessionHeight",file,sep = ""),".png",sep = ""))
            boxplot(subjectsBoxPlotSession$height,main="Session's height")
            dev.off()        
            
            png(paste(paste("boxPlotSessionWeight",file,sep = ""),".png",sep = ""))
            boxplot(subjectsBoxPlotSession$weight,main="Session's weight")
            dev.off()  
            
            "GET viability SUBJECT'S SESSION"
            
            sql <- sprintf("select count(d.viability) from dispense d where d.projectId = %s and d.sessionId = %s group by d.viability order by count(d.viability)" ,projectId,sessionId)    
            dispenseViabilitySession <- execSQLQuery(mydb, sql)
            
            sql <- sprintf("select distinct d.viability from dispense d where d.projectId = %s and d.sessionId = %s order by d.viability",projectId,sessionId)  
            viabilitiesSession <- execSQLQuery(mydb, sql)
            
            png(paste(paste("barplotSubjectsViabilitySession",file,sep = ""),".png",sep = ""))
            barplot(as.numeric(unlist(dispenseViabilitySession)),main="Session's viability"
                    , xlab="", ylab="Occurrences",names.arg = as.matrix(viabilitiesSession))
            dev.off()
            
            "GET reaction SUBJECT'S PROJECT"
            
            sql <- sprintf("select count(d.reaction) from dispense d where d.projectId = %s and d.sessionId = %s group by d.reaction" ,projectId,sessionId)    
            dispenseReactionSession <- execSQLQuery(mydb, sql)
            
            sql <- sprintf("select distinct d.reaction from dispense d where d.projectId = %s and d.sessionId = %s order by d.reaction",projectId,sessionId)  
            reactionsSession <- execSQLQuery(mydb, sql)
            
            png(paste(paste("barplotSubjectsReactionSession",file,sep = ""),".png",sep = ""))
            barplot(as.numeric(unlist(dispenseReactionSession)),main="Session's reaction"
                    , xlab="", ylab="Occurrences",names.arg = as.matrix(reactionsSession))
            dev.off()
            
            "GET DOSE SUBJECT'S PROJECT"
            sql <- sprintf("select * from dispense d, subject s where d.projectId = %s and d.sessionId = %s and d.subjectId = s.id" ,projectId,sessionId)    
            dispenseBoxPlotSession <- execSQLQuery(mydb, sql)
            
            png(paste(paste("boxPlotSessionDose",file,sep = ""),".png",sep = ""))
            boxplot(dispenseBoxPlotSession$dose,main="Session's dose")
            dev.off()       
            
            
            sql <- sprintf("select * from dispense d, subject s where d.projectId = %s and d.sessionId = %s and d.subjectId = s.id" ,projectId,sessionId)    
            subject <- execSQLQuery(mydb, sql)
            
            sql <- sprintf("select * from dispense d, subject s where d.projectId = %s and d.sessionId = %s and d.subjectId = s.id" ,projectId,sessionId)    
            dispense <- execSQLQuery(mydb, sql)
            
            png(paste(paste("boxPlotCorrelationWeightDose",file,sep = ""),".png",sep = ""))
            plot(subject$weight, dispense$dose,
                 main = "Relationship between subject's dose and weight",
                 xlab = "Weight",
                 ylab = "Dose")
            abline(lm(dispense$dose ~ subject$weight))
            dev.off()       
            
            png(paste(paste("boxPlotCorrelationHeightDose",file,sep = ""),".png",sep = ""))
            plot(subject$height, dispense$dose,
                 main = "Relationship between subject's dose and height",
                 xlab = "Height",
                 ylab = "Dose")
            abline(lm(dispense$dose ~ subject$height))
            dev.off()  
            
            generatedFiles<-list(paste("statisticsFiles/graphs/session/",paste(paste("barplotSessionSideEffectsSession",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/session/",paste(paste("boxPlotSessionHeight",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/session/",paste(paste("boxPlotSessionWeight",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/session/",paste(paste("barplotSubjectsViabilitySession",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/session/",paste(paste("barplotSubjectsReactionSession",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/session/",paste(paste("boxPlotSessionDose",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/session/",paste(paste("boxPlotCorrelationWeightDose",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/session/",paste(paste("boxPlotCorrelationHeightDose",file,sep = ""),".png",sep = ""),sep = "")
            )
          },
          "10030" = {
            mydb <- openDB("root", "root", "pharmatesis", "127.0.0.1")
            setwd("/home/dev/public_html/pharmatesis-app/statisticsFiles/graphs/phase/")
            
            inputData<-fromJSON(inputData$jsonData, simplifyWithNames=FALSE)
            
            projectId <- inputData$project$id
            phaseId <- inputData$phase$id
            
            file <- paste(projectId,phaseId,sep = "")
            
            "GET USERID FROM PROJECT"
            sql <- sprintf("select userId from project where id = %s" ,projectId)
            userId <- execSQLQuery(mydb, sql)
            
            "GET Side Effects SUBJECT'S SESSION"
            
            sql <- sprintf("select count(d.sideEffects) from dispense d where d.projectId = %s and d.phaseId = %s group by d.sideEffects order by count(d.sideEffects)" ,projectId,phaseId)    
            dispenseSideEffectsPhase <- execSQLQuery(mydb, sql)
            
            sql <- sprintf("select distinct sideEffects from dispense d where d.projectId = %s and d.phaseId = %s order by d.sideEffects",projectId,phaseId)  
            sideEffectsPhase <- execSQLQuery(mydb, sql)
            
            
            png(paste(paste("barplotPhaseSideEffects",file,sep = ""),".png",sep = ""))
            barplot(as.numeric(unlist(dispenseSideEffectsPhase)),main="Phase's side effects"
                    , xlab="", ylab="Occurrences",names.arg = as.matrix(sideEffectsPhase))
            dev.off()
            
            "GET HEIGHT and WEIGHT SUBJECT'S Phase"
            sql <- sprintf("select * from dispense d, subject s where d.projectId = %s and d.phaseId = %s and d.subjectId = s.id" ,projectId,phaseId)    
            subjectsBoxPlotPhase <- execSQLQuery(mydb, sql)
            
            png(paste(paste("boxPlotPhaseHeight",file,sep = ""),".png",sep = ""))
            boxplot(subjectsBoxPlotPhase$height,main="Phase's height")
            dev.off()        
            
            png(paste(paste("boxPlotPhaseWeight",file,sep = ""),".png",sep = ""))
            boxplot(subjectsBoxPlotPhase$weight,main="Phase's weight")
            dev.off()  
            
            "GET viability SUBJECT'S Phase"
            
            sql <- sprintf("select count(d.viability) from dispense d where d.projectId = %s and d.phaseId = %s group by d.viability order by count(d.viability)" ,projectId,phaseId)    
            dispenseViabilityPhase <- execSQLQuery(mydb, sql)
            
            sql <- sprintf("select distinct d.viability from dispense d where d.projectId = %s and d.phaseId = %s order by d.viability",projectId,phaseId)  
            viabilitiesPhase <- execSQLQuery(mydb, sql)
            
            png(paste(paste("barplotSubjectsViabilityPhase",file,sep = ""),".png",sep = ""))
            barplot(as.numeric(unlist(dispenseViabilityPhase)),main="Phase's viability"
                    , xlab="", ylab="Occurrences",names.arg = as.matrix(viabilitiesPhase))
            dev.off()
            
            "GET reaction SUBJECT'S Phase"
            
            sql <- sprintf("select count(d.reaction) from dispense d where d.projectId = %s and d.phaseId = %s group by d.reaction" ,projectId,phaseId)    
            dispenseReactionPhase <- execSQLQuery(mydb, sql)
            
            sql <- sprintf("select distinct d.reaction from dispense d where d.projectId = %s and d.phaseId = %s order by d.reaction",projectId,phaseId)  
            reactionsPhase <- execSQLQuery(mydb, sql)
            
            png(paste(paste("barplotSubjectsReactionPhase",file,sep = ""),".png",sep = ""))
            barplot(as.numeric(unlist(dispenseReactionPhase)),main="Phase's reaction"
                    , xlab="", ylab="Occurrences",names.arg = as.matrix(reactionsPhase))
            dev.off()
            
            "GET DOSE SUBJECT'S Phase"
            sql <- sprintf("select * from dispense d, subject s where d.projectId = %s and d.phaseId = %s and d.subjectId = s.id" ,projectId,phaseId)    
            dispenseBoxPlotPhase <- execSQLQuery(mydb, sql)
            
            png(paste(paste("boxPlotPhaseDose",file,sep = ""),".png",sep = ""))
            boxplot(dispenseBoxPlotPhase$dose,main="Phase's dose")
            dev.off()       
            
            
            sql <- sprintf("select * from dispense d, subject s where d.projectId = %s and d.phaseId = %s and d.subjectId = s.id" ,projectId,phaseId)    
            subject <- execSQLQuery(mydb, sql)
            
            sql <- sprintf("select * from dispense d, subject s where d.projectId = %s and d.phaseId = %s and d.subjectId = s.id" ,projectId,phaseId)    
            dispense <- execSQLQuery(mydb, sql)
            
            png(paste(paste("boxPlotCorrelationWeightDose",file,sep = ""),".png",sep = ""))
            plot(subject$weight, dispense$dose,
                 main = "Relationship between subject's dose and weight",
                 xlab = "Weight",
                 ylab = "Dose")
            abline(lm(dispense$dose ~ subject$weight))
            dev.off()       
            
            png(paste(paste("boxPlotCorrelationHeightDose",file,sep = ""),".png",sep = ""))
            plot(subject$height, dispense$dose,
                 main = "Relationship between subject's dose and height",
                 xlab = "Height",
                 ylab = "Dose")
            abline(lm(dispense$dose ~ subject$height))
            dev.off()  
            
            generatedFiles<-list(paste("statisticsFiles/graphs/phase/",paste(paste("barplotPhaseSideEffects",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/phase/",paste(paste("boxPlotPhaseHeight",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/phase/",paste(paste("boxPlotPhaseWeight",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/phase/",paste(paste("barplotSubjectsViabilityPhase",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/phase/",paste(paste("barplotSubjectsReactionPhase",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/phase/",paste(paste("boxPlotPhaseDose",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/phase/",paste(paste("boxPlotCorrelationWeightDose",file,sep = ""),".png",sep = ""),sep = ""),
                                 paste("statisticsFiles/graphs/phase/",paste(paste("boxPlotCorrelationHeightDose",file,sep = ""),".png",sep = ""),sep = "")
            )
          }
  )
  
  outPutData <- list(1, generatedFiles)
  
  sendBin (toJSON(outPutData))
}

