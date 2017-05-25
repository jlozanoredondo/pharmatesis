"
  @name: StatisticsController.R
  @Author: Jonathan Lozano & Joan Fernández
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
          
          sql <- sprintf("select count(distinct subjectId) from dispense where projectId = %s" ,inputData$jsonData)

          subjectsCountProject <- execSQLQuery(mydb, sql)

          sql <- sprintf("select subjectId from dispense where projectId = %s group by subjectId" ,inputData$jsonData)    

          subjectsIdProject <- execSQLQuery(mydb, sql)
          
          for ( a in subjectsIdProject ) {
            sql <- sprintf(paste("select * from subject where id = ",a,sep=""));
            subjectsProject <- execSQLQuery(mydb, sql)
          }
          
            generatedFiles<-c(subjectsProject)
          }
  )
  
  outPutData <- list(1, generatedFiles)
  
  sendBin (toJSON(outPutData))
}

