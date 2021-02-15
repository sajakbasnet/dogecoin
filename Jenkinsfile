pipeline {
  agent any
  environment {
    BRANCH = 'ver-8'
  }
  stages {
      stage('Sonarqube') {
      environment {
        scannerHome = tool 'SonarQubeScanner'
      }
      steps {
        if(BRANCH.contains(env.BRANCH_NAME)) {
          withSonarQubeEnv('sonarqube') {
            sh "${scannerHome}/bin/sonar-scanner"
          }
          timeout(time: 10, unit: 'MINUTES') {
            waitForQualityGate abortPipeline: true
          }
        }
        else{
          echo env.BRANCH_NAME + " branch is not being scanned!!"
        }
      }
    }
  }
}