#!groovy
kubernetes.pod('some_ephemeral_builder').withImage('russjt/docker-git-gcloud').inside {  
    //git 'https://github.com/jenkinsci/kubernetes-pipeline.git'
    sh 'hello from some pod using russjt/docker-git-cloud'
}    
/*
node {
 agent {
    kubernetes {
      //cloud 'kubernetes-plugin-test'
      label 'mypod'
      containerTemplate {
        name 'maven'
        image 'maven:3.3.9-jdk-8-alpine'
        ttyEnabled true
        command 'cat'
      }
    }
  }

 stages {
    stage('Build') {
      agent {
        docker {
          reuseNode true
          image 'russjt/docker-git-gcloud'
        }
      }
      steps {
        checkout scm
        sh 'cd docker/prod && make deploy'
      }
    }

    stage('Test') {
      agent {
        docker {
          reuseNode true
          image 'jimbo/php-dummy-image-prod'
        }
      }
      steps {
        sh """
            cd /var/www/html/ 
            mkdir test-results 
            ./vendor/bin/phpunit ./test/ --log-junit test-results/result.xml
        """
      }
    }
    
    /*
     stage('Deploy') {
      agent {
        docker {
          reuseNode true
          image 'jimbo/php-dummy-image-prod'
        }
      }
      steps {
        sh 'cd /var/www/html/ && mkdir test-results &&  ./vendor/bin/phpunit ./test/ --log-junit test-results/result.xml'
      }
    }
    }
}
    */
