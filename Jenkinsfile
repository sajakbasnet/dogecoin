pipeline {
  agent any
    tools {nodejs "nodejs-16"}
    environment {        
        scannerHome = tool 'SonarQubeScan'        
    }  
  stages {
      stage("Checkout code") {
            steps {
                checkout scm
            }
        }        
          stage('SonarQube Analysis') {            
            steps {           
              withSonarQubeEnv(installationName: 'SonarQubePro') {
                sh "${scannerHome}/bin/sonar-scanner"
            }
            }
          } 
  }
}
