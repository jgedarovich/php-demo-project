#!groovy
withCredentials([string(credentialsId: 'GCLOUD_CREDS', variable: 'GCLOUD_CREDS')]) {

    stage('Build') {
        kubernetes.pod('some_ephemeral_builder')
            .withPrivileged(true).
            .withImage('jgedarovich/docker-git-gcloud')
            .inside 
        {  
            checkout scm
            sh """
                echo ${GCLOUD_CREDS} | base64 -d > ${HOME}/gcp-key.json
                gcloud auth activate-service-account --key-file ${HOME}/gcp-key.json
                gcloud --quiet config set project etsy-gke-sandbox # maybe this should be baked in to the image 
                cd docker/prod && make deploy
            """
        }    
    }
    stage('Test') {
        kubernetes.pod('some_ephemeral_builder').withImage('jgedarovich/docker-git-gcloud').inside {  
            //git 'https://github.com/jenkinsci/kubernetes-pipeline.git'
            sh 'echo "TEST: hello from some pod using jgedarovich/docker-git-cloud"'
        }    
    }
    stage('Deploy') {
        kubernetes.pod('some_ephemeral_builder').withImage('jgedarovich/docker-git-gcloud').inside {  
            //git 'https://github.com/jenkinsci/kubernetes-pipeline.git'
            sh 'echo "DEPLOY: hello from some pod using jgedarovich/docker-git-cloud"'
        }    
    }
}
/*
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
