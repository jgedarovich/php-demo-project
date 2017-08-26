#!groovy
podTemplate(
    label: 'spellcorrection-builder',
    containers: [
        //TODO:
        //  * change cat to modify the hosts file
        containerTemplate(
            name: 'dind-gcloud',
            image: 'jgedarovich/docker-git-gcloud:latest',
            privileged: true,
            ttyEnabled: true,
            resourceRequestCpu: '200m',
            resourceLimitCpu: '200m',
            resourceRequestMemory: '4000Mi',
            resourceLimitMemory: '4000Mi',
            command: 'cat'
        ),
    ],
    volumes: [
        hostPathVolume(mountPath: '/var/run/docker.sock', hostPath: '/var/run/docker.sock'), // for dind bc privlidged alon isn't working...
        hostPathVolume(mountPath: '/var/lib/docker', hostPath: '/var/lib/docker'), // TODO: might not work
    ]
) {
    node('spellcorrection-builder') {
        stage('Build') {
            container('dind-gcloud') {
                sh "ls -lrta /var/run/docker.sock"
                withCredentials([string(credentialsId: 'GCLOUD_CREDS', variable: 'GCLOUD_CREDS')]) {
                    catchError {
                        checkout scm
                        sh """
                            export DOCKER_API_VERSION=1.23
                            ls -lrta /var/run/docker.sock
                            docker images
                            ls -lrta /usr/bin/gcloud
                            echo ${GCLOUD_CREDS}
                            echo ${GCLOUD_CREDS} | base64 -d > ${HOME}/gcp-key.json
                            cat ${HOME}/gcp-key.json
                            gcloud auth activate-service-account --key-file ${HOME}/gcp-key.json
                            gcloud --quiet config set project etsy-gke-sandbox # maybe this should be baked in to the image
                            cd docker/prod && make deploy
                        """
                        //archiveArtifacts artifacts: '_bazel*'
                        // bazel-bin/apps/spell_correction/spell_server_java_docker
                    }
                }
            }
        }
    }
}
