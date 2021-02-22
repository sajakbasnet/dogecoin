pipeline {
  agent 
  {
    docker {
      image 'node:current-alpine3.10'    
      args '-v /var/lib/jenkins/tools/hudson.plugins.sonar.SonarRunnerInstallation:/var/lib/jenkins/tools/hudson.plugins.sonar.SonarRunnerInstallation'  
    }
  }
  environment {
    BRANCH = 'ver-8'
  }
  stages {
      stage('Sonarqube') {
      environment {
        scannerHome = tool 'SonarQubeScanner'
      }
      steps {
        script{
          if(BRANCH.contains(env.BRANCH_NAME)) {
            stage('Sonarqube scan'){            
              withSonarQubeEnv('SonarQube') {
                sh "${scannerHome}/bin/sonar-scanner"
              }
              timeout(time: 10, unit: 'MINUTES') {
                waitForQualityGate abortPipeline: true
              }
            }
          }
          else{
            stage('No Scan'){
              echo env.BRANCH_NAME + " branch is not being scanned!!"
            }
          }
        }
      }
    }
  }
}
