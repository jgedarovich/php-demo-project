#!groovy
withCredentials([string(credentialsId: 'GCLOUD_CREDS', variable: 'GCLOUD_CREDS')]) {

    stage('Build') {
        /*node {
            git 'https://github.com/jgedarovich/php-demo-project.git'
            kubernetes.image().withName("jimbo/php-dummy-image-prod").build().fromPath("docker/prod")
        }*/

        kubernetes.pod('some_ephemeral_builder').withImage('jgedarovich/docker-git-gcloud').inside {  
        
        //node { // this will use the normal kubernetes plugin worker which is setup for dind / gcloud already.
            checkout scm
            sh 'ls -lrta /usr/bin/gcloud'
            sh "echo ${GCLOUD_CREDS}"
            sh """
                echo ${GCLOUD_CREDS} | base64 -d > ${HOME}/gcp-key.json
                cat ${HOME}/gcp-key.json
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
