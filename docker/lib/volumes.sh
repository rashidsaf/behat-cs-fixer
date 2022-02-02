#!/usr/bin/env bash

set -euo pipefail

root="$( cd "$( dirname "${BASH_SOURCE[0]}" )"/../../ && pwd )"

. "$root/submodules/docker/lib/volumes.sh"

# Associative array mapping Docker Volume names to paths. Extends array defined in Submodules Docker volumes script.
VOLUMES["gherkin_cs_fixer_project"]="$root"
export VOLUMES

# Associative array mapping Docker Volume targets to types. Extends array defined in Submodules Docker volumes script.
VOLUME_TYPES["gherkin_cs_fixer_project"]=$DIRECTORY
export VOLUME_TYPES

export PROJECT_VOLUME="gherkin_cs_fixer_project"
