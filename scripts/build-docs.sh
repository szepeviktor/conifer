#!/usr/bin/env bash

echo "Building documentation..."

yarn gitbook install
yarn gitbook build