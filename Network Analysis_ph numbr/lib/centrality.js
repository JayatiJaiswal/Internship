
Viva.Graph.centrality = function () {
    var singleSourceShortestPath = function (graph, node, oriented) {
            
            var P = {}, // predcessors lists. 
                S = [],
                sigma = {},
                d = {},
                Q = [node.id],
                v,
                dV,
                sigmaV,
                processNode = function (w) {
                    // w found for the first time?
                    if (!d.hasOwnProperty(w.id)) {
                        Q.push(w.id);
                        d[w.id] = dV + 1;
                    }
                    // Shortest path to w via v?
                    if (d[w.id] === dV + 1) {
                        sigma[w.id] += sigmaV;
                        P[w.id].push(v);
                    }
                };

            graph.forEachNode(function (t) {
                P[t.id] = [];
                sigma[t.id] = 0;
            });

            d[node.id] = 0;
            sigma[node.id] = 1;

            while (Q.length) { // Using BFS to find shortest paths
                v = Q.shift();
                dV = d[v];
                sigmaV = sigma[v];

                S.push(v);
                graph.forEachLinkedNode(v, processNode, oriented);
            }

            return {
                S : S,
                P : P,
                sigma : sigma
            };
        },

        accumulate = function (betweenness, shortestPath, s) {
            var delta = {},
                S = shortestPath.S,
                i,
                w,
                coeff,
                pW,
                v;

            for (i = 0; i < S.length; i += 1) {
                delta[S[i]] = 0;
            }

            // S returns vertices in order of non-increasing distance from s
            while (S.length) {
                w = S.pop();
                coeff = (1 + delta[w]) / shortestPath.sigma[w];
                pW = shortestPath.P[w];

                for (i = 0; i < pW.length; i += 1) {
                    v = pW[i];
                    delta[v] += shortestPath.sigma[v] * coeff;
                }

                if (w !== s) {
                    betweenness[w] += delta[w];
                }
            }
        },

        sortBetweennes = function (b) {
            var sorted = [],
                key;
            for (key in b) {
                if (b.hasOwnProperty(key)) {
                    sorted.push({ key : key, value : b[key]});
                }
            }

            return sorted.sort(function (x, y) { return y.value - x.value; });
        };

    return {

        /**
         * Compute the shortest-path betweenness centrality for all nodes in a graph.
         * 
         * Betweenness centrality of a node `n` is the sum of the fraction of all-pairs 
         * shortest paths that pass through `n`. Runtime O(n * v) for non-weighted graphs.
         *
         * @param graph for which we are calculating betweenness centrality. Non-weighted graphs are only supported 
         * @param oriented - identifies how to treat the graph
         */
        betweennessCentrality : function (graph, oriented) {
            var betweennes = {},
                shortestPath;
            graph.forEachNode(function (node) {
                betweennes[node.id] = 0;
            });

            graph.forEachNode(function (node) {
                shortestPath = singleSourceShortestPath(graph, node);
                accumulate(betweennes, shortestPath, node);
            });

            return sortBetweennes(betweennes);
        },

        /**
         * Calculates graph nodes degree centrality (in/out or both).
         * 
         * @param graph for which we are calculating centrality.
         * @param kind optional parameter. Valid values are
         *   'in'  - calculate in-degree centrality
         *   'out' - calculate out-degree centrality
         *         - if it's not set generic degree centrality is calculated
         */
        degreeCentrality : function (graph, kind) {
            var calcDegFunction,
                sortedDegrees = [],
                result = [],
                degree;

            kind = (kind || 'both').toLowerCase();
            if (kind === 'in') {
                calcDegFunction = function (links, nodeId) {
                    var total = 0,
                        i;
                    for (i = 0; i < links.length; i += 1) {
                        total += (links[i].toId === nodeId) ? 1 : 0;
                    }
                    return total;
                };
            } else if (kind === 'out') {
                calcDegFunction = function (links, nodeId) {
                    var total = 0,
                        i;
                    for (i = 0; i < links.length; i += 1) {
                        total += (links[i].fromId === nodeId) ? 1 : 0;
                    }
                    return total;
                };
            } else if (kind === 'both') {
                calcDegFunction = function (links, nodeId) {
                    return links.length;
                };
            } else {
                throw 'Expected centrality degree kind is: in, out or both';
            }

            graph.forEachNode(function (node) {
                var links = graph.getLinks(node.id),
                    nodeDeg = calcDegFunction(links, node.id);

                if (!sortedDegrees.hasOwnProperty(nodeDeg)) {
                    sortedDegrees[nodeDeg] = [node.id];
                } else {
                    sortedDegrees[nodeDeg].push(node.id);
                }
            });

            for (degree in sortedDegrees) {
                if (sortedDegrees.hasOwnProperty(degree)) {
                    var nodes = sortedDegrees[degree],
                        j;
                    if (nodes) {
                        for (j = 0; j < nodes.length; ++j) {
                            result.unshift({key : nodes[j], value : parseInt(degree, 10)});
                        }
                    }
                }
            }

            return result;
        }
    };
};
