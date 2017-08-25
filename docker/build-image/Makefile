DOCKER ?= docker

REPO := jgedarovich/docker-git-gcloud
DATE := $(shell date '+%Y-%m-%d_%H-%M')

default: container

deploy: container
	$(DOCKER) push $(REPO):latest
	$(DOCKER) push $(REPO):$(DATE)

container: 
	$(DOCKER) build -t $(REPO):latest -t $(REPO):$(DATE) .

.PHONY: container deploy default
